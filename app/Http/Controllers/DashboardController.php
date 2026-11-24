<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Meter;
use App\Models\MeterReading;
use App\Models\Payment;

class DashboardController extends Controller
{
    /**
     * Display the main application dashboard.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Determine Financial Access
        |--------------------------------------------------------------------------
        |
        | Only Admin and Manager are allowed to receive financial
        | dashboard information.
        |
        */

        $isFinancialUser = in_array(
            auth()->user()->role,
            ['admin', 'manager'],
            true
        );


        /*
        |--------------------------------------------------------------------------
        | Customer Statistics
        |--------------------------------------------------------------------------
        */

        $totalCustomers = Customer::count();

        $activeCustomers = Customer::where('status', 'active')->count();

        $inactiveCustomers = max(
            0,
            $totalCustomers - $activeCustomers
        );


        /*
        |--------------------------------------------------------------------------
        | Meter Statistics
        |--------------------------------------------------------------------------
        */

        $totalMeters = Meter::count();

        $activeMeters = Meter::where('status', 'active')->count();


        /*
        |--------------------------------------------------------------------------
        | Meter Reading Statistics
        |--------------------------------------------------------------------------
        */

        $totalReadings = MeterReading::count();


        /*
        |--------------------------------------------------------------------------
        | Billing Statistics
        |--------------------------------------------------------------------------
        |
        | These are operational billing counts and remain available
        | to all authenticated users.
        |
        */

        $totalBills = Bill::count();

        $paidBills = Bill::where('balance', '<=', 0)->count();

        $unpaidBills = Bill::where('balance', '>', 0)->count();


        /*
        |--------------------------------------------------------------------------
        | Financial Dashboard Defaults
        |--------------------------------------------------------------------------
        |
        | Operators receive zero/empty values for financial information.
        | Admins and Managers receive the real financial figures below.
        |
        */

        $totalBilled = 0;

        $outstandingBalance = 0;

        $totalPaid = 0;

        $thisMonthRevenue = 0;

        $currentYear = now()->year;

        $monthlyRevenue = [];


        /*
        |--------------------------------------------------------------------------
        | Financial Statistics — Admin + Manager Only
        |--------------------------------------------------------------------------
        */

        if ($isFinancialUser) {

            /*
            |------------------------------------------------------------------
            | Total Billed
            |------------------------------------------------------------------
            */

            $totalBilled = (float) Bill::sum('water_charge');


            /*
            |------------------------------------------------------------------
            | Outstanding Balance
            |------------------------------------------------------------------
            */

            $outstandingBalance = max(
                0,
                (float) Bill::sum('balance')
            );


            /*
            |------------------------------------------------------------------
            | Total Payments / Revenue
            |------------------------------------------------------------------
            */

            $totalPaid = (float) Payment::sum('amount');


            /*
            |------------------------------------------------------------------
            | This Month Revenue
            |------------------------------------------------------------------
            */

            $thisMonthRevenue = (float) Payment::whereMonth(
                    'payment_date',
                    now()->month
                )
                ->whereYear(
                    'payment_date',
                    now()->year
                )
                ->sum('amount');


            /*
            |------------------------------------------------------------------
            | Monthly Revenue
            |------------------------------------------------------------------
            |
            | Creates revenue figures for January - December
            | for the current year.
            |
            */

            for ($month = 1; $month <= 12; $month++) {

                $monthlyRevenue[] = (float) Payment::whereMonth(
                        'payment_date',
                        $month
                    )
                    ->whereYear(
                        'payment_date',
                        $currentYear
                    )
                    ->sum('amount');
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Recent Unpaid Bills
        |--------------------------------------------------------------------------
        |
        | These contain financial balances, so they are only loaded for
        | Admin and Manager.
        |
        */

        $recentUnpaidBills = collect();

        if ($isFinancialUser) {

            $recentUnpaidBills = Bill::with([
                    'customer',
                    'meterReading.meter'
                ])
                ->where('balance', '>', 0)
                ->latest('billing_date')
                ->take(5)
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | Recent Bills
        |--------------------------------------------------------------------------
        |
        | Operational billing activity remains available to all users.
        |
        */

        $recentBills = Bill::with('customer')
            ->latest('billing_date')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Payments
        |--------------------------------------------------------------------------
        |
        | Payment amounts are financial information, therefore they are
        | only loaded for Admin and Manager on the dashboard.
        |
        */

        $recentPayments = collect();

        if ($isFinancialUser) {

            $recentPayments = Payment::with([
                    'bill',
                    'customer'
                ])
                ->latest('payment_date')
                ->take(5)
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | Send Data To Dashboard
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'isFinancialUser',

            'totalCustomers',
            'activeCustomers',
            'inactiveCustomers',

            'totalMeters',
            'activeMeters',

            'totalReadings',

            'totalBills',
            'totalBilled',
            'paidBills',
            'unpaidBills',
            'outstandingBalance',

            'totalPaid',
            'thisMonthRevenue',

            'monthlyRevenue',
            'currentYear',

            'recentUnpaidBills',
            'recentBills',
            'recentPayments'
        ));
    }
}

