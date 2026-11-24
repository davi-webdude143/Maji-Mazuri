<?php
    $money = fn ($value) => 'KSh ' . number_format((float) $value, 2);

    $maxTrend = max(1, (float) $trend->max('income'));

    $presets = [
        'this_month' => 'This month',
        'last_month' => 'Last month',
        'last_3_months' => 'Last 3 months',
    ];

    $methods = [
        [
            'label' => 'M-PESA',
            'amount' => $incomeMpesaCollected,
            'color' => '#22c55e',
        ],
        [
            'label' => 'Cash',
            'amount' => $incomeCashCollected,
            'color' => '#f59e0b',
        ],
        [
            'label' => 'Bank',
            'amount' => $incomeBankCollected,
            'color' => '#a78bfa',
        ],
    ];
?>

<style>
    .inc {
        margin: 2.5rem 0 2rem;
        color: #e5e7eb;
    }

    .inc *,
    .inc *::before,
    .inc *::after {
        box-sizing: border-box;
    }

    .inc h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0 0 1rem;
    }

    .inc-card {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
    }

    .inc-muted {
        color: #94a3b8;
        font-size: 0.85rem;
    }

    .inc-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .inc-chips {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .inc-chip {
        font-size: 0.8rem;
        padding: 0.3rem 0.75rem;
        border-radius: 8px;
        border: 1px solid #334155;
        color: #94a3b8;
        text-decoration: none;
        transition: 0.15s ease;
    }

    .inc-chip:hover {
        border-color: #2563eb;
        color: #bfdbfe;
    }

    .inc-chip.active {
        background: rgba(37, 99, 235, 0.2);
        border-color: #2563eb;
        color: #93c5fd;
    }

    .inc-grid4 {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .inc-field label {
        display: block;
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 0.35rem;
    }

    .inc-field input,
    .inc-field select {
        width: 100%;
        height: 44px;
        padding: 0 0.75rem;
        background: #111c33;
        color: #e5e7eb;
        border: 1px solid #334155;
        border-radius: 12px;
        font-size: 0.95rem;
        color-scheme: dark;
        outline: none;
    }

    .inc-field input:focus,
    .inc-field select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .inc-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .inc-btn {
        height: 44px;
        padding: 0 1.25rem;
        border-radius: 12px;
        border: 1px solid #334155;
        background: #1e293b;
        color: #e5e7eb;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.15s ease;
    }

    .inc-btn:hover {
        background: #263449;
        border-color: #475569;
    }

    .inc-btn.primary {
        background: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }

    .inc-btn.primary:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
    }

    .inc-btn.sm {
        height: 38px;
        padding: 0 1rem;
        font-size: 0.85rem;
    }

    .inc-right {
        margin-left: auto;
        display: flex;
        gap: 0.5rem;
    }

    .inc-stat .v {
        font-size: 1.6rem;
        font-weight: 700;
        margin-top: 0.25rem;
    }

    .inc-green {
        color: #22c55e;
    }

    .inc-red {
        color: #ef4444;
    }

    .inc-two {
        display: grid;
        grid-template-columns: minmax(0, 3fr) minmax(0, 2fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .inc table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.92rem;
    }

    .inc th {
        text-align: left;
        font-weight: 500;
        color: #94a3b8;
        font-size: 0.8rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid #1e293b;
    }

    .inc td {
        padding: 0.7rem 0;
        border-bottom: 1px solid #1e293b;
    }

    .inc .r {
        text-align: right;
    }

    .inc-bar {
        height: 6px;
        background: #1e293b;
        border-radius: 4px;
        overflow: hidden;
    }

    .inc-bar > span {
        display: block;
        height: 6px;
        border-radius: 4px;
    }

    .inc-trend {
        display: flex;
        align-items: flex-end;
        gap: 1rem;
        height: 130px;
    }

    .inc-trend > div {
        flex: 1;
        min-width: 0;
        text-align: center;
    }

    .inc-empty {
        text-align: center;
        padding: 1.5rem 0;
        color: #94a3b8;
    }

    .inc-print-only {
        display: none;
    }

    @media print {
        .inc {
            color: #111827;
        }

        .inc-card {
            background: #fff;
            border-color: #d1d5db;
        }

        .inc-muted {
            color: #6b7280;
        }

        .inc-actions,
        .inc-chips {
            display: none !important;
        }

        .inc-bar {
            background: #e5e7eb;
        }

        .inc-print-only {
            display: block;
        }
    }

    @media (max-width: 900px) {
        .inc-grid4 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .inc-two {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .inc {
            margin-top: 2rem;
        }

        .inc-card {
            padding: 1rem;
        }

        .inc-grid4 {
            grid-template-columns: 1fr;
        }

        .inc-right {
            margin-left: 0;
            width: 100%;
        }

        .inc-right .inc-btn {
            flex: 1;
        }

        .inc-trend {
            gap: 0.5rem;
        }

        .inc table {
            font-size: 0.8rem;
        }
    }
</style>

<section class="inc" id="income-report">

    <h2>Income Report</h2>

    
    <form
        method="GET"
        action="<?php echo e(url()->current()); ?>#income-report"
        class="inc-card"
    >
        <div class="inc-head">
            <div>
                <div style="font-weight: 600;">
                    Income filters
                </div>

                <div class="inc-muted">
                    Choose a month range, region and payment method.
                    These filters affect only this Income Report.
                </div>
            </div>

            <div class="inc-chips">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $presets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a
                        class="inc-chip <?php echo e($incomePreset === $key ? 'active' : ''); ?>"
                        href="<?php echo e(url()->current()); ?>?<?php echo e(http_build_query([
                            'income_preset' => $key,
                            'income_region' => $incomeRegion,
                            'income_payment_method' => $incomePaymentMethod,
                        ])); ?>#income-report"
                    >
                        <?php echo e($label); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="inc-grid4">

            <div class="inc-field">
                <label for="income_from_month">
                    From month
                </label>

                <input
                    type="month"
                    id="income_from_month"
                    name="income_from_month"
                    value="<?php echo e($incomeFromMonth); ?>"
                >
            </div>

            <div class="inc-field">
                <label for="income_to_month">
                    To month
                </label>

                <input
                    type="month"
                    id="income_to_month"
                    name="income_to_month"
                    value="<?php echo e($incomeToMonth); ?>"
                >
            </div>

            <div class="inc-field">
                <label for="income_region">
                    Region
                </label>

                <select
                    id="income_region"
                    name="income_region"
                >
                    <option value="">
                        All regions
                    </option>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($area); ?>"
                            <?php if($incomeRegion === $area): echo 'selected'; endif; ?>
                        >
                            <?php echo e($area); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>

            <div class="inc-field">
                <label for="income_payment_method">
                    Payment method
                </label>

                <select
                    id="income_payment_method"
                    name="income_payment_method"
                >
                    <option value="">
                        All methods
                    </option>

                    <option
                        value="mpesa"
                        <?php if($incomePaymentMethod === 'mpesa'): echo 'selected'; endif; ?>
                    >
                        M-PESA
                    </option>

                    <option
                        value="cash"
                        <?php if($incomePaymentMethod === 'cash'): echo 'selected'; endif; ?>
                    >
                        Cash
                    </option>

                    <option
                        value="bank"
                        <?php if($incomePaymentMethod === 'bank'): echo 'selected'; endif; ?>
                    >
                        Bank
                    </option>
                </select>
            </div>

        </div>

        <div class="inc-actions">

            <button
                type="submit"
                class="inc-btn primary"
            >
                Generate report
            </button>

            <a
                href="<?php echo e(url()->current()); ?>#income-report"
                class="inc-btn"
            >
                Clear
            </a>

            <div class="inc-right">

                <button
                    type="button"
                    class="inc-btn sm"
                    onclick="window.print()"
                >
                    Print / PDF
                </button>

                <a
                    class="inc-btn sm"
                    href="<?php echo e(request()->fullUrlWithQuery([
                        'income_export' => 'csv',
                    ])); ?>"
                >
                    CSV
                </a>

            </div>
        </div>
    </form>

    
    <p
        class="inc-muted"
        style="margin: 1.25rem 0 0.75rem;"
    >
        Showing income collected for
        <?php echo e($incomePeriodLabel); ?>,
        <?php echo e($incomeRegionLabel); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($incomePaymentMethod): ?>
            , <?php echo e(strtoupper($incomePaymentMethod)); ?> only
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </p>

    
    <div class="inc-grid4">

        <div class="inc-card inc-stat">
            <div class="inc-muted">
                Total income
            </div>

            <div class="v inc-green">
                <?php echo e($money($incomeTotalCollected)); ?>

            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!is_null($incomeChange)): ?>
                <div
                    class="inc-muted <?php echo e($incomeChange >= 0 ? 'inc-green' : 'inc-red'); ?>"
                    style="margin-top: 0.25rem;"
                >
                    <?php echo e($incomeChange >= 0 ? '+' : ''); ?><?php echo e($incomeChange); ?>%
                    vs previous period
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="inc-card inc-stat">
            <div class="inc-muted">
                Payments
            </div>

            <div class="v">
                <?php echo e(number_format($incomeTotalPayments)); ?>

            </div>

            <div class="inc-muted">
                Average <?php echo e($money($incomeAveragePayment)); ?>

            </div>
        </div>

        <div class="inc-card inc-stat">
            <div class="inc-muted">
                Customers paid
            </div>

            <div class="v">
                <?php echo e(number_format($incomeCustomersPaid)); ?>

            </div>

            <div class="inc-muted">
                of <?php echo e(number_format($incomeCustomersInScope)); ?> customers
            </div>
        </div>

        <div class="inc-card inc-stat">
            <div class="inc-muted">
                Outstanding
            </div>

            <div class="v inc-red">
                <?php echo e($money($incomeTotalOutstanding)); ?>

            </div>

            <div class="inc-muted">
                <?php echo e($incomeCollectionRate); ?>% of billed collected
            </div>
        </div>

    </div>

    
    <div class="inc-two">

        
        <div class="inc-card">

            <div
                style="
                    font-weight: 600;
                    margin-bottom: 0.5rem;
                "
            >
                Income by region
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($incomeByRegionAnalysis->isEmpty()): ?>

                <div class="inc-empty">
                    No payments found for these filters.
                    Try a wider range.
                </div>

            <?php else: ?>

                <table>
                    <thead>
                        <tr>
                            <th>Region</th>
                            <th class="r">Payments</th>
                            <th class="r">Income</th>
                            <th
                                style="
                                    padding-left: 1rem;
                                    width: 28%;
                                "
                            >
                                Share
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $incomeByRegionAnalysis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                                $share = $incomeTotalCollected > 0
                                    ? round(
                                        ($row['income'] / $incomeTotalCollected) * 100
                                    )
                                    : 0;
                            ?>

                            <tr>

                                <td>
                                    <?php echo e($row['region']); ?>

                                </td>

                                <td class="r">
                                    <?php echo e(number_format($row['payments'])); ?>

                                </td>

                                <td class="r">
                                    <?php echo e($money($row['income'])); ?>

                                </td>

                                <td style="padding-left: 1rem;">

                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 0.5rem;
                                        "
                                    >

                                        <div
                                            class="inc-bar"
                                            style="flex: 1;"
                                        >
                                            <span
                                                style="
                                                    width: <?php echo e(min(100, max(0, $share))); ?>%;
                                                    background: #2563eb;
                                                "
                                            ></span>
                                        </div>

                                        <span class="inc-muted">
                                            <?php echo e($share); ?>%
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <tr style="font-weight: 600;">

                            <td style="border: 0;">
                                Total
                            </td>

                            <td
                                class="r"
                                style="border: 0;"
                            >
                                <?php echo e(number_format($incomeTotalPayments)); ?>

                            </td>

                            <td
                                class="r"
                                style="border: 0;"
                            >
                                <?php echo e($money($incomeTotalCollected)); ?>

                            </td>

                            <td
                                style="
                                    border: 0;
                                    padding-left: 1rem;
                                "
                                class="inc-muted"
                            >
                                100%
                            </td>

                        </tr>

                    </tbody>
                </table>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

        
        <div class="inc-card">

            <div
                style="
                    font-weight: 600;
                    margin-bottom: 1rem;
                "
            >
                Payment method
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $percentage = $incomeTotalCollected > 0
                        ? round(
                            ($method['amount'] / $incomeTotalCollected) * 100
                        )
                        : 0;
                ?>

                <div style="margin-bottom: 1rem;">

                    <div
                        style="
                            display: flex;
                            justify-content: space-between;
                            font-size: 0.9rem;
                            margin-bottom: 0.35rem;
                        "
                    >
                        <span>
                            <?php echo e($method['label']); ?>

                        </span>

                        <span>
                            <?php echo e($money($method['amount'])); ?>

                        </span>
                    </div>

                    <div
                        class="inc-bar"
                        style="height: 8px;"
                    >
                        <span
                            style="
                                height: 8px;
                                width: <?php echo e(min(100, max(0, $percentage))); ?>%;
                                background: <?php echo e($method['color']); ?>;
                            "
                        ></span>
                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>

    
    <div
        class="inc-card"
        style="margin-top: 1rem;"
    >

        <div
            style="
                font-weight: 600;
                margin-bottom: 1rem;
            "
        >
            Income by month
        </div>

        <div class="inc-trend">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $trend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trendMonth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $height = max(
                        4,
                        round(
                            ($trendMonth['income'] / $maxTrend) * 90
                        )
                    );
                ?>

                <div style="align-self: flex-end;">

                    <div
                        class="inc-muted"
                        style="
                            font-size: 0.7rem;
                            margin-bottom: 0.25rem;
                            min-height: 1rem;
                        "
                    >
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trendMonth['income'] > 0): ?>
                            <?php echo e(number_format($trendMonth['income'])); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div
                        title="<?php echo e($trendMonth['label']); ?>: <?php echo e($money($trendMonth['income'])); ?>"
                        style="
                            height: <?php echo e($height); ?>px;
                            border-radius: 6px 6px 0 0;
                            background: <?php echo e($trendMonth['selected'] ? '#2563eb' : '#1e3a8a'); ?>;
                        "
                    ></div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

        <div
            style="
                display: flex;
                gap: 1rem;
                margin-top: 0.4rem;
            "
        >

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $trend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trendMonth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <span
                    class="inc-muted"
                    style="
                        flex: 1;
                        text-align: center;
                        <?php echo e($trendMonth['selected'] && $incomeFromMonth
                            ? 'color: #e5e7eb; font-weight: 600;'
                            : ''); ?>

                    "
                >
                    <?php echo e($trendMonth['label']); ?>

                </span>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>

</section>

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/reports/income.blade.php ENDPATH**/ ?>