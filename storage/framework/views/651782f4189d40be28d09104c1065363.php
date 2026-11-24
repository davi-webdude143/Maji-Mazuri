<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">


<title><?php echo e($bill->invoice_number); ?></title>

<style>
    @page {
        size: A4 portrait;
        margin: 8mm 10mm;
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        color: #222;
        font-size: 9px;
        line-height: 1.3;
    }

    .invoice {
        width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* =========================
       HEADER
    ========================= */

    .header {
        width: 100%;
        border-bottom: 3px solid #1976d2;
        padding-bottom: 7px;
        margin-bottom: 10px;
    }

    .logo {
        display: block;
        width: auto;
        height: 58px;
        margin-bottom: 5px;
    }

    .header-table {
        width: 100%;
    }

    .company {
        width: 55%;
        vertical-align: top;
    }

    .invoice-info {
        width: 45%;
        vertical-align: top;
        text-align: right;
    }

    .contact {
        color: #555;
        font-size: 8.5px;
        line-height: 1.5;
    }

    .invoice-title {
        font-size: 23px;
        font-weight: bold;
        line-height: 1;
        color: #111;
    }

    .invoice-number {
        margin-top: 3px;
        font-size: 12px;
        font-weight: bold;
        color: #1976d2;
    }

    .invoice-date {
        margin-top: 5px;
        color: #555;
        font-size: 8.5px;
        line-height: 1.5;
    }

    /* =========================
       DETAILS
    ========================= */

    .details-table {
        margin-bottom: 10px;
    }

    .details-table td {
        width: 50%;
        vertical-align: top;
    }

    .details-table td:first-child {
        padding-right: 5px;
    }

    .details-table td:last-child {
        padding-left: 5px;
    }

    .detail-box {
        border: 1px solid #dfe4e8;
        border-radius: 3px;
        padding: 7px 9px;
        min-height: 72px;
    }

    .section-title {
        font-size: 7px;
        color: #888;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: .8px;
        margin-bottom: 3px;
    }

    .customer-name {
        font-size: 11px;
        font-weight: bold;
        color: #111;
        margin-bottom: 3px;
    }

    .detail-line {
        color: #555;
        font-size: 8px;
        line-height: 1.45;
    }

    /* =========================
       BILLING TABLE
    ========================= */

    .billing-table {
        margin-top: 2px;
        margin-bottom: 8px;
        table-layout: fixed;
    }

    .billing-table th {
        background: #f1f5f9;
        color: #4b5563;
        font-size: 7px;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 6px 7px;
        border-top: 1px solid #dce2e7;
        border-bottom: 1px solid #dce2e7;
    }

    .billing-table td {
        padding: 8px 7px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 8.5px;
        vertical-align: top;
    }

    .billing-table th:nth-child(1),
    .billing-table td:nth-child(1) {
        width: 50%;
    }

    .billing-table th:nth-child(2),
    .billing-table td:nth-child(2) {
        width: 15%;
    }

    .billing-table th:nth-child(3),
    .billing-table td:nth-child(3) {
        width: 17%;
    }

    .billing-table th:nth-child(4),
    .billing-table td:nth-child(4) {
        width: 18%;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .description {
        font-weight: bold;
        color: #222;
    }

    .description-small {
        font-size: 7px;
        color: #777;
        margin-top: 1px;
    }

    /* =========================
       TOTALS
    ========================= */

    .totals-wrapper {
        width: 100%;
        margin-top: 5px;
        margin-bottom: 8px;
    }

    .totals-table {
        width: 45%;
        margin-left: auto;
    }

    .totals-table td {
        padding: 4px 6px;
        font-size: 8.5px;
    }

    .total-label {
        color: #666;
    }

    .total-value {
        text-align: right;
        font-weight: bold;
        color: #222;
    }

    .credit-row td {
        background: #ecfdf5;
        color: #166534;
        border-top: 1px solid #bbf7d0;
        border-bottom: 1px solid #bbf7d0;
    }

    .credit-note {
        margin-top: 5px;
        margin-left: auto;
        width: 45%;
        padding: 5px 7px;
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        color: #166534;
        font-size: 7.5px;
        line-height: 1.4;
    }

    .balance-row td {
        background: #eaf4ff;
        color: #155a94;
        padding: 7px 6px;
        font-size: 10px;
        font-weight: bold;
        border-top: 1px solid #c9e2f8;
        border-bottom: 1px solid #c9e2f8;
    }

    /* =========================
       PAYMENT INSTRUCTIONS
    ========================= */

    .payment-section {
        margin-top: 8px;
        margin-bottom: 8px;
        border: 1px solid #b9d9f5;
        background: #f4f9ff;
        padding: 8px 10px;
    }

    .payment-table {
        width: 100%;
    }

    .payment-table td {
        vertical-align: middle;
    }

    .payment-title {
        font-size: 9px;
        font-weight: bold;
        color: #155a94;
        margin-bottom: 3px;
    }

    .payment-subtitle {
        font-size: 7.5px;
        color: #555;
        line-height: 1.4;
    }

    .paybill-box {
        text-align: right;
        white-space: nowrap;
    }

    .paybill-label {
        font-size: 7px;
        color: #666;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: .5px;
    }

    .paybill-number {
        font-size: 16px;
        font-weight: bold;
        color: #1976d2;
        margin-top: 1px;
    }

    .account-number {
        margin-top: 2px;
        font-size: 7.5px;
        color: #555;
    }

    .account-number strong {
        color: #222;
    }

    /* =========================
       PAYMENT STATUS
    ========================= */

    .status-section {
        margin-top: 7px;
        border-top: 1px solid #ddd;
        padding-top: 7px;
    }

    .status-table {
        width: 100%;
    }

    .status-table td {
        width: 50%;
        vertical-align: middle;
    }

    .status-table td:last-child {
        text-align: right;
    }

    .status {
        display: inline-block;
        padding: 4px 9px;
        border-radius: 10px;
        font-size: 7px;
        font-weight: bold;
        letter-spacing: .3px;
    }

    .status-paid {
        background: #dcfce7;
        color: #166534;
    }

    .status-partial {
        background: #fef3c7;
        color: #92400e;
    }

    .status-overdue {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-unpaid {
        background: #eee;
        color: #444;
    }

    .company-slogan {
        font-size: 8px;
        color: #555;
        line-height: 1.4;
    }

    /* =========================
       FOOTER
    ========================= */

    .footer {
        margin-top: 8px;
        background: #17212b;
        color: white;
        text-align: center;
        padding: 6px 8px;
    }

    .footer-main {
        font-size: 8.5px;
        font-weight: bold;
    }

    .footer-small {
        margin-top: 1px;
        color: #b8c0c7;
        font-size: 6.5px;
    }

    /* =========================
       PAGE CONTROL
    ========================= */

    .header,
    .details-table,
    .billing-table,
    .totals-wrapper,
    .payment-section,
    .status-section,
    .footer {
        page-break-inside: avoid;
    }

    tr {
        page-break-inside: avoid;
    }
</style>
```

</head>

<body>

<div class="invoice">

```


<div class="header">

    <img
        src="<?php echo e(public_path('images/pure-tide-mazuri-logo.png')); ?>"
        class="logo"
        alt="Pure Tide Mazuri Ltd"
    >

    <table class="header-table">
        <tr>

            <td class="company">

                <div class="contact">
                    <strong>Phone:</strong>
                    0723 875 395
                    <br>

                    <strong>Email:</strong>
                    puretidemazuri@gmail.com
                </div>

            </td>

            <td class="invoice-info">

                <div class="invoice-title">
                    INVOICE
                </div>

                <div class="invoice-number">
                    <?php echo e($bill->invoice_number); ?>

                </div>

                <div class="invoice-date">
                    <strong>Invoice Date:</strong>
                    <?php echo e($bill->billing_date->format('d M Y')); ?>

                    <br>

                    <strong>Reading Date:</strong>
                    <?php echo e($bill->meterReading->reading_date->format('d M Y')); ?>

                </div>

            </td>

        </tr>
    </table>

</div>




<table class="details-table">

    <tr>

        <td>

            <div class="detail-box">

                <div class="section-title">
                    Bill To
                </div>

                <div class="customer-name">
                    <?php echo e($bill->customer->full_name); ?>

                </div>

                <div class="detail-line">

                    <strong>Customer No:</strong>
                    <?php echo e($bill->customer->customer_number); ?>


                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->customer->phone_number): ?>
                        <br>
                        <strong>Phone:</strong>
                        <?php echo e($bill->customer->phone_number); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->customer->email): ?>
                        <br>
                        <strong>Email:</strong>
                        <?php echo e($bill->customer->email); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

            </div>

        </td>


        <td>

            <div class="detail-box">

                <div class="section-title">
                    Meter Details
                </div>

                <div class="customer-name">
                    <?php echo e($bill->meterReading->meter->meter_number); ?>

                </div>

                <div class="detail-line">

                    <strong>Previous Reading:</strong>
                    <?php echo e(number_format($bill->meterReading->previous_reading, 2)); ?>


                    <br>

                    <strong>Current Reading:</strong>
                    <?php echo e(number_format($bill->meterReading->current_reading, 2)); ?>


                    <br>

                    <strong>Consumption:</strong>
                    <?php echo e(number_format($bill->consumption, 2)); ?> units

                </div>

            </div>

        </td>

    </tr>

</table>




<table class="billing-table">

    <thead>

        <tr>

            <th class="text-left">
                Description
            </th>

            <th class="text-right">
                Units
            </th>

            <th class="text-right">
                Rate
            </th>

            <th class="text-right">
                Amount
            </th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>

                <div class="description">
                    Water Consumption
                </div>

                <div class="description-small">
                    Water usage for the billing period
                </div>

            </td>

            <td class="text-right">
                <?php echo e(number_format($bill->consumption, 2)); ?>

            </td>

            <td class="text-right">
                KSh <?php echo e(number_format($bill->rate_per_unit, 2)); ?>

            </td>

            <td class="text-right">
                <strong>
                    KSh <?php echo e(number_format($bill->water_charge, 2)); ?>

                </strong>
            </td>

        </tr>

    </tbody>

</table>




<div class="totals-wrapper">

    <table class="totals-table">

        <tr>

            <td class="total-label">
                Water Charge
            </td>

            <td class="total-value">
                KSh <?php echo e(number_format($bill->water_charge, 2)); ?>

            </td>

        </tr>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->previous_balance > 0): ?>

            <tr>

                <td class="total-label">
                    Previous Balance
                </td>

                <td class="total-value">
                    KSh <?php echo e(number_format($bill->previous_balance, 2)); ?>

                </td>

            </tr>

            <tr>

                <td class="total-label">
                    Total Before Credit
                </td>

                <td class="total-value">
                    KSh <?php echo e(number_format(
                        (float) $bill->water_charge + (float) $bill->previous_balance,
                        2
                    )); ?>

                </td>

            </tr>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->credit_applied > 0): ?>

            <tr class="credit-row">

                <td class="total-label">
                    Credit Applied
                </td>

                <td class="total-value">
                    - KSh <?php echo e(number_format($bill->credit_applied, 2)); ?>

                </td>

            </tr>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <tr>

            <td class="total-label">
                Amount Paid
            </td>

            <td class="total-value">
                KSh <?php echo e(number_format($bill->amount_paid, 2)); ?>

            </td>

        </tr>

        <tr class="balance-row">

            <td>
                Balance Due
            </td>

            <td class="text-right">
                KSh <?php echo e(number_format($bill->balance, 2)); ?>

            </td>

        </tr>

    </table>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->credit_applied > 0): ?>

        <div class="credit-note">
            <strong>Payment Method:</strong>
            Customer Account Credit
            <br>
            This invoice was settled using previously available customer credit.
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>




<div class="payment-section">

    <table class="payment-table">

        <tr>

            <td style="width: 55%;">

                <div class="payment-title">
                    M-PESA PAYMENT INSTRUCTIONS
                </div>

                <div class="payment-subtitle">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->balance <= 0): ?>

                        This invoice has been fully settled.
                        For future payments, use the PayBill number below
                        and your Customer Number as the Account Number.

                    <?php else: ?>

                        Go to M-PESA → Lipa na M-PESA → PayBill.
                        <br>
                        Enter the PayBill number and use your Customer Number as the Account Number.

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

            </td>

            <td style="width: 45%;" class="paybill-box">

                <div class="paybill-label">
                    PayBill Number
                </div>

                <div class="paybill-number">
                    4321629
                </div>

                <div class="account-number">
                    <strong>Account Number:</strong>
                    <?php echo e($bill->customer->customer_number); ?>

                </div>

            </td>

        </tr>

    </table>

</div>




<div class="status-section">

    <table class="status-table">

        <tr>

            <td>

                <div class="section-title">
                    Payment Status
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->status === 'paid'): ?>

                    <span class="status status-paid">
                        PAID
                    </span>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->credit_applied > 0): ?>

                        <div style="margin-top: 5px; font-size: 7.5px; color: #166534;">
                            ✓ Settled using customer account credit
                        </div>

                    <?php else: ?>

                        <div style="margin-top: 5px; font-size: 7.5px; color: #166534;">
                            ✓ This invoice has been fully paid.
                        </div>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php elseif($bill->status === 'partially_paid'): ?>

                    <span class="status status-partial">
                        PARTIALLY PAID
                    </span>

                <?php elseif($bill->status === 'overdue'): ?>

                    <span class="status status-overdue">
                        OVERDUE
                    </span>

                <?php else: ?>

                    <span class="status status-unpaid">
                        UNPAID
                    </span>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </td>

            <td>

                <strong>
                    PURE TIDE MAZURI LTD
                </strong>

                <br>

                <span class="company-slogan">
                    PURE WATER. PURE LIFE.
                </span>

            </td>

        </tr>

    </table>

</div>




<div class="footer">

    <div class="footer-main">
        Thank you for your business.
    </div>

    <div class="footer-small">
        Please retain this invoice for your records.
    </div>

</div>


</div>

</body>
</html>
<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\bills\pdf.blade.php ENDPATH**/ ?>