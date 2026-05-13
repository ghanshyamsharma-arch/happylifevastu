<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(ucfirst($appname)); ?> - Invoice</title>
    <style type="text/css">
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 80px;
            height: 80px;
        }

        .header h1 {
            margin: 10px 0 5px;
            font-size: 24px;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #777;
        }

        .text-bold {
            font-weight: bold;
        }

        .w-100{
        width: 100%;
    }

    .gray-color{
        color:#5D5D5D;
    }



        .table-section {
            width: 100%;
            margin-bottom: 20px;
        }

        .table-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-section th, .table-section td {
            border: 1px solid #e0e0e0;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .table-section th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .table-section img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .total-section {
            text-align: right;
            margin-top: 20px;
        }

        .total-section p {
            margin: 5px 0;
            font-size: 14px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .footer p {
            margin: 5px 0;
        }

        .signatory {
            margin-top: 20px;
            text-align: right;
            font-size: 14px;
        }

        .signatory p {
            margin: 5px 0;
        }
        .box-text p{
        line-height:10px;
    }

    
    </style>
</head>

<body>
    <?php
    $siteemail = DB::table('systemflag')->where('name', 'siteemail')->first();
    $siteaddress = DB::table('systemflag')->where('name', 'siteaddress')->first();
    $sitenumber = DB::table('systemflag')->where('name', 'sitenumber')->first();
    $signature = DB::table('systemflag')->where('name', 'InvoiceSignature')->first();
    
    ?>
    <div class="container">
        <!-- Header Section -->
        <div class="header" style="margin-bottom: 30px">
            <img src="<?php echo e(url($logo->value)); ?>" alt="Logo">
            <h1><?php echo e(ucfirst($appname)); ?></h1>
            <p><?php echo e($siteaddress->value); ?></p>
            <p>Email: <?php echo e($siteemail->value); ?> | Phone: <?php echo e($sitenumber->value); ?></p>
        </div>

        <div class="add-detail" style="margin-bottom: 50px; position: relative; width: 100%;">
            <p class="text-bold" style="position: absolute; left: 0; margin: 0;">Invoice Id - <span class="gray-color">#<?php echo e($order->id); ?></span></p>
            <p class="text-bold" style="position: absolute; right: 0; margin: 0;">Order Date - <span class="gray-color"><?php echo e(date('d-m-Y h:i a', strtotime($order->created_at))); ?></span></p>
        </div>
        
        

        <div class="table-section bill-tbl w-100 mt-10">
            <table class="table w-100 mt-10">
                <tr>
                    <th class="w-50">Details</th>
                    <th class="w-50">Address</th>
                </tr>
                <tr>
                    <td>
                        <div class="box-text ">
                            <p>Name : <?php echo e($order->userName); ?></p>
                            <p>Email: <?php echo e($order->userEmail); ?></p>
                            <p>Contact: <?php echo e($order->userContactNo); ?></p>
                           
                        </div>
                    </td>
                    <td>
                        <div class="box-text">
                            <p> <?php echo e($order->flatNo); ?>,<?php echo e($order->landmark); ?></p>
                            <p><?php echo e($order->city); ?>,<?php echo e($order->state); ?></p>
                            <p><?php echo e($order->country); ?>-<?php echo e($order->pincode); ?></p>                    
                           
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Order Details Table -->
        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->productName ?? '-'); ?></td>
                        <td class="text-center">
                            <?php if($item->productImage): ?>
                                <img src="<?php echo e(url($item->productImage)); ?>" alt="Product Image">
                            <?php else: ?>
                                <span>N/A</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($item->quantity ?? 1); ?></td>
                        <td class="text-center"><?php echo e($currencySymbol->value); ?><?php echo e(number_format($item->unitPrice ?? 0, 2)); ?></td>
                        <td class="text-center"><?php echo e($currencySymbol->value); ?><?php echo e(number_format($item->totalPrice ?? 0, 2)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">No items found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Order Status -->
        <div style="margin-top: 20px; margin-bottom: 20px;">
            <p><strong>Order Status:</strong> <span style="color: #666;"><?php echo e($order->orderStatus); ?></span></p>
        </div>

        <!-- Total Section -->
        <div class="total-section">
            <p>Sub Total: <?php echo e($currencySymbol->value); ?><?php echo e($order->payableAmount); ?></p>
            <p>Total Payable: <?php echo e($currencySymbol->value); ?><?php echo e($order->totalPayable); ?></p>
            <p style="font-size: 12px;">(incl. of all taxes)</p>
        </div>

        <!-- Signatory Section -->
        <div class="signatory">
            <p>Authorised Signatory</p>
            <img style="height:55px;width:55px" src="<?php echo e(url($signature->value)); ?>" alt="Signature">
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>This is a system-generated invoice, so a signature is not required.</p>
            <p>Thank you for your order!</p>
        </div>
    </div>
</body>

</html><?php /**PATH /home/happylifevastu/public_html/resources/views/pages/invoice.blade.php ENDPATH**/ ?>