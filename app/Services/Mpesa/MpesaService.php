<?php

namespace App\Services\Mpesa;

use Exception;
use Illuminate\Support\Facades\Http;

class MpesaService
{
    /**
     * Get the Daraja API base URL.
     */
    protected function baseUrl(): string
    {
        return env('MPESA_ENV', 'sandbox') === 'production'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';
    }

    /**
     * Generate an OAuth access token from Daraja.
     */
    public function getAccessToken(): string
    {
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');

        if (!$consumerKey || !$consumerSecret) {
            throw new Exception(
                'M-PESA Consumer Key or Consumer Secret is missing.'
            );
        }

        $response = Http::withBasicAuth(
            $consumerKey,
            $consumerSecret
        )->get(
            $this->baseUrl() .
            '/oauth/v1/generate?grant_type=client_credentials'
        );

        if ($response->failed()) {
            throw new Exception(
                'M-PESA authorization failed: ' .
                $response->body()
            );
        }

        $data = $response->json();

        if (!isset($data['access_token'])) {
            throw new Exception(
                'M-PESA access token was not returned.'
            );
        }

        return $data['access_token'];
    }

    /**
     * Register M-PESA C2B PayBill validation
     * and confirmation URLs.
     */
    public function registerC2BUrls(): array
    {
        $accessToken = $this->getAccessToken();

        $shortCode = env('MPESA_SHORTCODE');
        $confirmationUrl = env('MPESA_C2B_CONFIRMATION_URL');
        $validationUrl = env('MPESA_C2B_VALIDATION_URL');

        if (!$shortCode) {
            throw new Exception(
                'M-PESA Short Code is missing.'
            );
        }

        if (!$confirmationUrl) {
            throw new Exception(
                'M-PESA C2B Confirmation URL is missing.'
            );
        }

        if (!$validationUrl) {
            throw new Exception(
                'M-PESA C2B Validation URL is missing.'
            );
        }

        $payload = [
            'ShortCode' => $shortCode,
            'ResponseType' => 'Completed',
            'ConfirmationURL' => $confirmationUrl,
            'ValidationURL' => $validationUrl,
        ];

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->post(
                $this->baseUrl() .
                '/mpesa/c2b/v2/registerurl',
                $payload
            );

        if ($response->failed()) {
            throw new Exception(
                'M-PESA C2B URL registration failed: ' .
                $response->body()
            );
        }

        $data = $response->json();

        /*
        |--------------------------------------------------------------------------
        | Handle Daraja Registration Response
        |--------------------------------------------------------------------------
        |
        | Safaricom sandbox may return:
        |
        | ResponseCode: 0
        | ResponseDescription: Success
        |
        | Some responses may contain only the description.
        |
        */

        $responseCode = isset($data['ResponseCode'])
            ? (string) $data['ResponseCode']
            : null;

        $responseDescription = strtolower(
            trim(
                (string) (
                    $data['ResponseDescription']
                    ?? $data['ResponseDesc']
                    ?? ''
                )
            )
        );

        $successfulResponse =
            $responseCode === '0'
            || $responseDescription === 'success';

        if (!$successfulResponse) {
            throw new Exception(
                'M-PESA C2B URL registration was rejected: ' .
                (
                    $data['ResponseDescription']
                    ?? $data['ResponseDesc']
                    ?? 'Unknown error.'
                )
            );
        }

        return $data;
    }

    /**
     * Initiate an M-PESA Express STK Push payment.
     */
    public function stkPush(
        float $amount,
        string $phoneNumber,
        string $accountReference,
        string $transactionDescription
    ): array {
        $accessToken = $this->getAccessToken();

        $shortCode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $callbackUrl = env('MPESA_CALLBACK_URL');

        if (!$shortCode || !$passkey) {
            throw new Exception(
                'M-PESA Short Code or Passkey is missing.'
            );
        }

        if (!$callbackUrl) {
            throw new Exception(
                'M-PESA Callback URL is missing.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Normalize Kenyan Phone Number
        |--------------------------------------------------------------------------
        */

        $phoneNumber = preg_replace(
            '/\D/',
            '',
            $phoneNumber
        );

        if (str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '254' . substr(
                $phoneNumber,
                1
            );
        }

        if (str_starts_with($phoneNumber, '+')) {
            $phoneNumber = substr(
                $phoneNumber,
                1
            );
        }

        if (!preg_match(
            '/^2547\d{8}$/',
            $phoneNumber
        )) {
            throw new Exception(
                'Invalid M-PESA phone number. ' .
                'Use 07XXXXXXXX or 2547XXXXXXXX.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | STK Push Timestamp
        |--------------------------------------------------------------------------
        */

        $timestamp = now()->format('YmdHis');

        /*
        |--------------------------------------------------------------------------
        | Generate Password
        |--------------------------------------------------------------------------
        */

        $password = base64_encode(
            $shortCode .
            $passkey .
            $timestamp
        );

        /*
        |--------------------------------------------------------------------------
        | STK Push Payload
        |--------------------------------------------------------------------------
        */

        $payload = [
            'BusinessShortCode' => $shortCode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int) round($amount),
            'PartyA' => $phoneNumber,
            'PartyB' => $shortCode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => $callbackUrl,

            'AccountReference' => substr(
                $accountReference,
                0,
                20
            ),

            'TransactionDesc' => substr(
                $transactionDescription,
                0,
                20
            ),
        ];

        /*
        |--------------------------------------------------------------------------
        | Send STK Push Request
        |--------------------------------------------------------------------------
        */

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->post(
                $this->baseUrl() .
                '/mpesa/stkpush/v1/processrequest',
                $payload
            );

        if ($response->failed()) {
            throw new Exception(
                'M-PESA STK Push failed: ' .
                $response->body()
            );
        }

        $data = $response->json();

        /*
        |--------------------------------------------------------------------------
        | Check Daraja Response
        |--------------------------------------------------------------------------
        */

        if (
            isset($data['ResponseCode']) &&
            (string) $data['ResponseCode'] !== '0'
        ) {
            throw new Exception(
                'M-PESA STK Push was rejected: ' .
                (
                    $data['ResponseDescription']
                    ?? 'Unknown error.'
                )
            );
        }

        return $data;
    }
}

