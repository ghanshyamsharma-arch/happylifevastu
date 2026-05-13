<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wallet History Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        h2 { margin: 5px 0; }
        p { margin: 2px 0; }
        img { max-height: 60px; margin-bottom: 5px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px 4px;
            font-size: 11px;
            word-wrap: break-word;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .filters {
            margin-top: 10px;
            font-size: 11px;
        }

        .filters ul {
            margin: 5px 0 0 15px;
            padding: 0;
        }

        .filters li {
            margin-bottom: 2px;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            color: #555;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <img src="https://astrotest.diploy.in/public/storage/images/AdminLogo1732085016.png" alt="Logo">
        <h2>Wallet History Report</h2>
        <p>Generated on: <strong><?php echo e($generated_at); ?></strong></p>
    </div>

    <div class="filters">
        <strong>Filters Applied:</strong>
        <?php if(request('searchString') || request('from_date') || request('to_date') || request('paymentMethod')): ?>
            <ul>
                <?php if(request('searchString')): ?>
                    <li>Search: "<?php echo e(request('searchString')); ?>"</li>
                <?php endif; ?>
                <?php if(request('paymentMethod')): ?>
                    <li>Payment Method: <?php echo e(ucfirst(request('paymentMethod'))); ?></li>
                <?php endif; ?>
                <?php if(request('from_date')): ?>
                    <li>From Date: <?php echo e(\Carbon\Carbon::parse(request('from_date'))->format('d-m-Y')); ?></li>
                <?php endif; ?>
                <?php if(request('to_date')): ?>
                    <li>To Date: <?php echo e(\Carbon\Carbon::parse(request('to_date'))->format('d-m-Y')); ?></li>
                <?php endif; ?>
            </ul>
        <?php else: ?>
            <span>None (All records included)</span>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">ID</th>
                <th style="width:100px;">User Name</th>
                <th style="width:80px;">Contact</th>
                <th style="width:50px;">Mode</th>
                <th style="width:70px;">Payment For</th>
                <th style="width:80px;">Reference</th>
                <th style="width:70px;" class="text-right">Amount (<?php echo e($currency->value ?? '₹'); ?>)</th>
                <th style="width:50px;" class="text-right">GST (<?php echo e($gst); ?>%)</th>
                <th style="width:80px;" class="text-right">Total Amount</th>
                <th style="width:50px;">Status</th>
                <th style="width:80px;">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $wallet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $normalAmount = $row->amount;
                    $gstAmount = ($normalAmount * $gst) / 100;
                    $totalAmount = $normalAmount + $gstAmount;
                ?>
                <tr>
                    <td class="text-center"><?php echo e($row->id); ?></td>
                    <td><?php echo e($row->userName); ?></td>
                    <td><?php echo e($row->userContact); ?></td>
                    <td><?php echo e(ucfirst($row->paymentMode)); ?></td>
                    <td><?php echo e($row->payment_for); ?></td>
                    <td><?php echo e($row->paymentReference); ?></td>
                    <td class="text-right"><?php echo e(number_format($normalAmount, 2)); ?></td>
                    <td class="text-right"><?php echo e(number_format($gstAmount, 2)); ?></td>
                    <td class="text-right"><?php echo e(number_format($totalAmount, 2)); ?></td>
                    <td class="text-center"><?php echo e(ucfirst($row->paymentStatus)); ?></td>
                    <td class="text-center"><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="11" class="text-center">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Report generated automatically by <?php echo e(config('app.name')); ?> on <?php echo e(now()->format('d-m-Y h:i A')); ?></p>
    </div>
</body>
</html>
<?php /**PATH /home/happylifevastu/public_html/resources/views/reports/wallet-history-pdf.blade.php ENDPATH**/ ?>