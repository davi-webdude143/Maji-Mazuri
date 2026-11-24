<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Outstanding Bills Report</title>

    <style>
        @page {
            margin: 18px 20px 25px 20px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 9px;
            line-height: 1.4;
            margin: 0;
        }

        .header {
            border-bottom: 2px solid #0f766e;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .company-name {
            color: #0f766e;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .tagline {
            color: #64748b;
            font-size: 8px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .report-title {
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px;
            color: #111827;
        }

        .report-date {
            color: #64748b;
            font-size: 8px;
            margin-top: 2px;
        }

        .summary {
            width: 100%;
            margin-bottom: 14px;
        }

        .summary td {
            width: 25%;
            padding-right: 6px;
            vertical-align: top;
        }

        .summary td:last-child {
            padding-right: 0;
        }

        .summary-card {
            border: 1px solid #dbe3e8;
            border-radius: 5px;
            padding: 8px;
            background: #f8fafc;
        }

        .summary-label {
            color: #64748b;
            font-size: 7px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .summary-value {
            color: #0f766e;
            font-size: 12px;
            font-weight: bold;
            margin-top: 3px;
        }

        .progress-section {
            border: 1px solid #dbe3e8;
            border-radius: 5px;
            padding: 9px;
            margin-bottom: 16px;
            background: #ffffff;
        }

        .progress-title {
            font-size: 8px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 8px;
            background: #0f766e;
        }

        .progress-text {
            margin-top: 4px;
            font-size: 7px;
            color: #64748b;
        }

        .customer-section {
            border: 1px solid #dbe3e8;
            border-radius: 5px;
            margin-bottom: 14px;
            page-break-inside: avoid;
            overflow: hidden;
        }

        .customer-header {
            background: #0f766e;
            color: #ffffff;
            padding: 8px 10px;
        }

        .customer-number {
            display: inline-block;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            background: #ffffff;
            color: #0f766e;
            border-radius: 50%;
            font-size: 9px;
            font-weight: bold;
            margin-right: 7px;
            vertical-align: middle;
        }

        .customer-name {
            font-size: 11px;
            font-weight: bold;
            vertical-align: middle;
        }

        .customer-info {
            background: #f8fafc;
            padding: 7px 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .customer-info table {
            width: 100%;
        }

        .customer-info td {
            padding: 2px 5px 2px 0;
            vertical-align: top;
        }

        .info-label {
            color: #64748b;
            font-size: 7px;
            text-transform: uppercase;
        }

        .info-value {
            color: #111827;
            font-size: 8px;
            font-weight: bold;
        }

        .bills-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bills-table th {
            background: #f1f5f9;
            color: #475569;
            font-size: 7px;
            text-transform: uppercase;
            letter-spacing: .3px;
            padding: 6px 5px;
            border-bottom: 1px solid #cbd5e1;
            text-align: left;
        }

        .bills-table td {
            padding: 6px 5px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 8px;
        }

        .bills-table tr:last-child td {
            border-bottom: none;
        }

        .amount {
            text-align: right;
            white-space: nowrap;
        }

        .outstanding {
            color: #b91c1c;
            font-weight: bold;
        }

        .customer-total {
            background: #f8fafc;
            padding: 7px 10px;
            border-top: 1px solid #e5e7eb;
        }

        .customer-total table {
            width: 100%;
        }

        .customer-total td {
            padding: 2px;
        }

        .total-label {
            text-align: right;
            color: #475569;
            font-weight: bold;
        }

        .total-value {
            text-align: right;
            color: #b91c1c;
            font-size: 10px;
            font-weight: bold;
            width: 100px;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        .footer {
            position: fixed;
            bottom: -15px;
            left: 0;
            right: 0;
            text-align: center;
            color: #94a3b8;
            font-size: 7px;
        }

        .page-number:after {
            content: counter(page);
        }
    </style>
</head>

<body>

    

    <div class="header">

        <div class="company-name">
            Pure Tide Mazuri Ltd
        </div>

        <div class="tagline">
            PURE WATER. PURE LIFE.
        </div>

        <div class="report-title">
            Outstanding Bills Report
        </div>

        <div class="report-date">
            Generated on <?php echo e(now()->format('d M Y, H:i')); ?>

        </div>

    </div>


    

    <table class="summary">

        <tr>

            
            <td>
                <div class="summary-card">

                    <div class="summary-label">
                        Customers With Balance
                    </div>

                    <div class="summary-value">
                        <?php echo e(number_format($customers ?? 0)); ?>

                    </div>

                </div>
            </td>


            
            <td>
                <div class="summary-card">

                    <div class="summary-label">
                        Outstanding Bills
                    </div>

                    <div class="summary-value">
                        <?php echo e(number_format($outstandingBills?->count() ?? 0)); ?>

                    </div>

                </div>
            </td>


            
            <td>
                <div class="summary-card">

                    <div class="summary-label">
                        Total Billed
                    </div>

                    <div class="summary-value">
                        KSh <?php echo e(number_format((float) ($totalBilled ?? 0), 2)); ?>

                    </div>

                </div>
            </td>


            
            <td>
                <div class="summary-card">

                    <div class="summary-label">
                        Total Outstanding
                    </div>

                    <div class="summary-value">
                        KSh <?php echo e(number_format((float) ($totalOutstanding ?? 0), 2)); ?>

                    </div>

                </div>
            </td>

        </tr>

    </table>


    

    <?php

        $reportTotalBilled = (float) ($totalBilled ?? 0);

        $reportTotalPaid = (float) ($totalPaid ?? 0);

        $reportTotalOutstanding = (float) ($totalOutstanding ?? 0);

        $reportCollectionPercentage = $reportTotalBilled > 0
            ? min(
                100,
                max(
                    0,
                    ($reportTotalPaid / $reportTotalBilled) * 100
                )
            )
            : 0;

        $reportOutstandingPercentage = $reportTotalBilled > 0
            ? min(
                100,
                max(
                    0,
                    ($reportTotalOutstanding / $reportTotalBilled) * 100
                )
            )
            : 0;

    ?>


    <div class="progress-section">

        <div class="progress-title">
            Collection Progress
        </div>

        <div class="progress-bar">

            <div
                class="progress-fill"
                style="width: <?php echo e($reportCollectionPercentage); ?>%;"
            ></div>

        </div>

        <div class="progress-text">

            Collected:
            KSh <?php echo e(number_format($reportTotalPaid, 2)); ?>

            (<?php echo e(number_format($reportCollectionPercentage, 1)); ?>%)

            &nbsp;&nbsp; | &nbsp;&nbsp;

            Outstanding:
            KSh <?php echo e(number_format($reportTotalOutstanding, 2)); ?>

            (<?php echo e(number_format($reportOutstandingPercentage, 1)); ?>%)

        </div>

    </div>


    

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customersWithBalances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customerIndex => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <?php

            /*
             * Customer details.
             */

            $customerName = trim(
                (string) ($customer->full_name ?? '')
            );

            if ($customerName === '') {
                $customerName = 'Customer';
            }

            $customerNumber = $customer->customer_number ?? 'N/A';

            $phoneNumber = $customer->phone_number ?? 'N/A';

            $area = $customer->area ?? 'N/A';


            /*
             * Customer report totals.
             */

            $customerOutstanding = (float) (
                $customer->report_outstanding ?? 0
            );

            $customerBilled = (float) (
                $customer->report_total_billed ?? 0
            );

            $customerPaid = (float) (
                $customer->report_total_paid ?? 0
            );


            /*
             * Customer bills.
             */

            $customerBills = $customer->bills ?? collect();

        ?>


        

        <div class="customer-section">


            
            <div class="customer-header">

                <span class="customer-number">
                    <?php echo e($customerIndex + 1); ?>

                </span>

                <span class="customer-name">
                    <?php echo e($customerName); ?>

                </span>

            </div>


            
            <div class="customer-info">

                <table>

                    <tr>

                        <td width="25%">

                            <div class="info-label">
                                Account Number
                            </div>

                            <div class="info-value">
                                <?php echo e($customerNumber); ?>

                            </div>

                        </td>


                        <td width="25%">

                            <div class="info-label">
                                Phone
                            </div>

                            <div class="info-value">
                                <?php echo e($phoneNumber); ?>

                            </div>

                        </td>


                        <td width="25%">

                            <div class="info-label">
                                Area
                            </div>

                            <div class="info-value">
                                <?php echo e($area); ?>

                            </div>

                        </td>


                        <td width="25%">

                            <div class="info-label">
                                Outstanding
                            </div>

                            <div class="info-value outstanding">
                                KSh <?php echo e(number_format($customerOutstanding, 2)); ?>

                            </div>

                        </td>

                    </tr>

                </table>

            </div>


            

            <table class="bills-table">

                <thead>

                    <tr>

                        <th width="15%">
                            Bill No.
                        </th>

                        <th width="15%">
                            Billing Date
                        </th>

                        <th width="15%">
                            Due Date
                        </th>

                        <th width="13%">
                            Status
                        </th>

                        <th width="14%" class="amount">
                            Billed
                        </th>

                        <th width="14%" class="amount">
                            Paid
                        </th>

                        <th width="14%" class="amount">
                            Balance
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customerBills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php

                            /*
                             * The actual water charge is the amount billed.
                             */
                            $billAmount = (float) (
                                $bill->water_charge ?? 0
                            );


                            /*
                             * Use the bill's recorded amount paid where
                             * available. Fall back to payment history.
                             */
                            $paidAmount = (float) (
                                $bill->amount_paid
                                ?? $bill->payments?->sum('amount')
                                ?? 0
                            );


                            /*
                             * Use the actual bill balance.
                             */
                            $balance = (float) (
                                $bill->balance
                                ?? max(
                                    0,
                                    $billAmount - $paidAmount
                                )
                            );

                        ?>


                        <tr>

                            
                            <td>
                                <?php echo e($bill->invoice_number ?? ('INV-' . $bill->id)); ?>

                            </td>


                            
                            <td>

                                <?php echo e($bill->billing_date
                                    ? \Carbon\Carbon::parse($bill->billing_date)->format('d M Y')
                                    : 'N/A'); ?>


                            </td>


                            
                            <td>

                                <?php echo e($bill->due_date
                                    ? \Carbon\Carbon::parse($bill->due_date)->format('d M Y')
                                    : 'N/A'); ?>


                            </td>


                            
                            <td>

                                <?php echo e(ucfirst(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $bill->status ?? 'N/A'
                                    )
                                )); ?>


                            </td>


                            
                            <td class="amount">

                                KSh <?php echo e(number_format(
                                    $billAmount,
                                    2
                                )); ?>


                            </td>


                            
                            <td class="amount">

                                KSh <?php echo e(number_format(
                                    $paidAmount,
                                    2
                                )); ?>


                            </td>


                            
                            <td class="amount outstanding">

                                KSh <?php echo e(number_format(
                                    $balance,
                                    2
                                )); ?>


                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </tbody>

            </table>


            

            <div class="customer-total">

                <table>

                    <tr>

                        <td class="total-label">
                            Customer Outstanding Balance:
                        </td>

                        <td class="total-value">
                            KSh <?php echo e(number_format(
                                $customerOutstanding,
                                2
                            )); ?>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        

        <div class="empty-state">
            No outstanding bills were found.
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


    

    <div class="footer">

        Pure Tide Mazuri Ltd

        &nbsp; | &nbsp;

        Outstanding Bills Report

        &nbsp; | &nbsp;

        Page <span class="page-number"></span>

    </div>

</body>

</html><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\bills\outstanding-pdf.blade.php ENDPATH**/ ?>