<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucfirst($appname) }} - Sacred Invoice</title>
    <style type="text/css">
        /* ═══════════════════════════════════════════════════════
           PREMIUM INVOICE — Sacred Luxury Theme
           Professional Print-Ready Design
           ═══════════════════════════════════════════════════════ */
        
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #faf4ea 0%, #ffffff 100%);
            color: #2c1a08;
        }
        
        /* Sacred Container */
        .sacred-invoice-container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e8d5b0;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(30, 15, 0, 0.07);
            overflow: hidden;
            position: relative;
        }
        
        /* Gold Top Border */
        .sacred-invoice-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, #e0c068 40%, #c9a84c 50%, #e0c068 60%, transparent 100%);
            z-index: 2;
        }
        
        /* Warm Texture Overlay */
        .sacred-invoice-container::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.015'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }
        
        .invoice-content {
            position: relative;
            z-index: 1;
            padding: 40px;
        }
        
        /* Header Section */
        .sacred-header {
            text-align: center;
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 2px solid #e8d5b0;
            position: relative;
        }
        
        .sacred-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #c9a84c, transparent);
        }
        
        .sacred-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
            border-radius: 50%;
            border: 2px solid #e8d5b0;
            padding: 5px;
        }
        
        .sacred-company-name {
            font-family: 'Cinzel', serif;
            font-size: 28px;
            font-weight: 700;
            color: #1a0e05;
            margin: 10px 0 8px;
            letter-spacing: 1px;
        }
        
        .sacred-company-details {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            color: #6b4c22;
            line-height: 1.6;
        }
        
        .sacred-company-details p {
            margin: 3px 0;
        }
        
        /* Gold Divider */
        .gold-divider {
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, #c9a84c, #e0c068);
            margin: 15px auto;
        }
        
        /* Invoice ID & Date Row */
        .invoice-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 15px 0;
            border-bottom: 1px dashed #e8d5b0;
        }
        
        .invoice-meta-item {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
        }
        
        .invoice-meta-label {
            font-weight: 700;
            color: #1a0e05;
            font-family: 'Cinzel', serif;
            font-size: 12px;
        }
        
        .invoice-meta-value {
            color: #b08a55;
            margin-left: 8px;
        }
        
        /* Customer Section */
        .customer-section {
            margin-bottom: 30px;
        }
        
        .sacred-card {
            background: linear-gradient(135deg, #fefcf8 0%, #faf4ea 100%);
            border: 1px solid #e8d5b0;
            border-radius: 16px;
            overflow: hidden;
        }
        
        .sacred-card-header {
            background: linear-gradient(135deg, #faf4ea 0%, #fdf6e3 100%);
            padding: 12px 20px;
            border-bottom: 1px solid #e8d5b0;
        }
        
        .sacred-card-header h3 {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            font-weight: 700;
            color: #c9a84c;
            margin: 0;
            letter-spacing: 1px;
        }
        
        .sacred-card-body {
            padding: 20px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .info-section p {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            line-height: 1.8;
            color: #6b4c22;
            margin: 5px 0;
        }
        
        .info-label {
            font-weight: 700;
            color: #1a0e05;
            min-width: 70px;
            display: inline-block;
        }
        
        /* Items Table */
        .items-table-section {
            margin-bottom: 30px;
        }
        
        .sacred-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Lato', sans-serif;
        }
        
        .sacred-table th {
            background: linear-gradient(135deg, #faf4ea 0%, #fdf6e3 100%);
            font-family: 'Cinzel', serif;
            font-size: 12px;
            font-weight: 700;
            color: #1a0e05;
            padding: 14px 10px;
            border: 1px solid #e8d5b0;
            text-align: center;
            letter-spacing: 0.5px;
        }
        
        .sacred-table td {
            padding: 12px 10px;
            border: 1px solid #e8d5b0;
            font-size: 12px;
            color: #6b4c22;
            text-align: center;
            vertical-align: middle;
        }
        
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e8d5b0;
        }
        
        /* Total Section */
        .total-section {
            text-align: right;
            padding: 20px;
            background: linear-gradient(135deg, #fefcf8 0%, #faf4ea 100%);
            border-radius: 16px;
            margin-top: 20px;
            border: 1px solid #e8d5b0;
        }
        
        .total-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .total-label {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            color: #6b4c22;
            width: 120px;
            text-align: left;
        }
        
        .total-value {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #2c1a08;
            min-width: 120px;
            text-align: right;
        }
        
        .grand-total-row {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 2px solid #c9a84c;
        }
        
        .grand-total-label {
            font-family: 'Cinzel', serif;
            font-size: 16px;
            font-weight: 700;
            color: #1a0e05;
        }
        
        .grand-total-value {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            font-weight: 800;
            color: #c9a84c;
        }
        
        .tax-note {
            font-size: 10px;
            color: #b08a55;
            margin-top: 8px;
        }
        
        /* Signatory Section */
        .signatory-section {
            margin-top: 30px;
            text-align: right;
            padding: 20px;
            border-top: 1px solid #e8d5b0;
        }
        
        .signatory-title {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            font-weight: 600;
            color: #6b4c22;
            margin-bottom: 10px;
        }
        
        .signature-img {
            height: 55px;
            width: auto;
            max-width: 150px;
            object-fit: contain;
            margin-top: 5px;
        }
        
        .signature-placeholder {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            color: #b08a55;
            font-style: italic;
        }
        
        /* Footer */
        .sacred-footer {
            text-align: center;
            padding: 20px 40px;
            background: linear-gradient(135deg, #faf4ea 0%, #fdf6e3 100%);
            border-top: 1px solid #e8d5b0;
            margin-top: 20px;
        }
        
        .sacred-footer p {
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            color: #b08a55;
            margin: 5px 0;
        }
        
        .sacred-footer .thanks-text {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            color: #c9a84c;
            margin-top: 10px;
        }
        
        /* Responsive */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            
            .sacred-invoice-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }
            
            .sacred-invoice-container::before,
            .sacred-invoice-container::after {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .invoice-content {
                padding: 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .sacred-table th,
            .sacred-table td {
                padding: 8px 5px;
                font-size: 10px;
            }
            
            .product-img {
                width: 40px;
                height: 40px;
            }
            
            .invoice-meta {
                flex-direction: column;
                gap: 8px;
            }
            
            .total-section {
                padding: 15px;
            }
            
            .total-label {
                width: 100px;
            }
            
            .grand-total-label {
                font-size: 14px;
            }
            
            .grand-total-value {
                font-size: 16px;
            }
        }
        
        @media (max-width: 576px) {
            .invoice-content {
                padding: 15px;
            }
            
            .sacred-company-name {
                font-size: 22px;
            }
            
            .sacred-table {
                font-size: 9px;
            }
            
            .sacred-table th,
            .sacred-table td {
                padding: 6px 3px;
            }
            
            .product-img {
                width: 35px;
                height: 35px;
            }
        }
        
        /* Utility Classes */
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .mt-10 {
            margin-top: 10px;
        }
        
        .mb-10 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    @php
        $siteemail   = DB::table('systemflag')->where('name', 'siteemail')->first();
        $siteaddress = DB::table('systemflag')->where('name', 'siteaddress')->first();
        $sitenumber  = DB::table('systemflag')->where('name', 'sitenumber')->first();
        $signature   = DB::table('systemflag')->where('name', 'InvoiceSignature')->first();
    @endphp

    <div class="sacred-invoice-container">
        <div class="invoice-content">
            
            {{-- ─── Sacred Header ─── --}}
            <div class="sacred-header">
                <img class="sacred-logo" src="{{ url($logo->value) }}" alt="{{ ucfirst($appname) }}">
                <h1 class="sacred-company-name">{{ ucfirst($appname) }}</h1>
                <div class="gold-divider"></div>
                <div class="sacred-company-details">
                    <p><i class="fa fa-map-marker-alt"></i> {{ $siteaddress->value ?? '' }}</p>
                    <p><i class="fa fa-envelope"></i> {{ $siteemail->value ?? '' }} | <i class="fa fa-phone"></i> {{ $sitenumber->value ?? '' }}</p>
                </div>
            </div>

            {{-- ─── Invoice ID + Date ─── --}}
            <div class="invoice-meta">
                <div class="invoice-meta-item">
                    <span class="invoice-meta-label">Sacred Invoice ID:</span>
                    <span class="invoice-meta-value">#{{ $order->id }}</span>
                </div>
                <div class="invoice-meta-item">
                    <span class="invoice-meta-label">Divine Order Date:</span>
                    <span class="invoice-meta-value">{{ date('d-m-Y h:i a', strtotime($order->created_at)) }}</span>
                </div>
            </div>

            {{-- ─── Customer Details + Address ─── --}}
            <div class="customer-section">
                <div class="sacred-card">
                    <div class="sacred-card-header">
                        <h3><i class="fa fa-user"></i> Sacred Seeker Details</h3>
                    </div>
                    <div class="sacred-card-body">
                        <div class="info-grid">
                            <div class="info-section">
                                <p><span class="info-label">Name:</span> {{ $order->userName }}</p>
                                <p><span class="info-label">Email:</span> {{ $order->userEmail }}</p>
                                <p><span class="info-label">Contact:</span> {{ $order->userContactNo }}</p>
                            </div>
                            <div class="info-section">
                                <p><span class="info-label">Address:</span> {{ $order->flatNo }}, {{ $order->landmark }}</p>
                                <p><span class="info-label">City:</span> {{ $order->city }}, {{ $order->state }}</p>
                                <p><span class="info-label">Country:</span> {{ $order->country }} - {{ $order->pincode }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── Order Items Table ─── --}}
            <div class="items-table-section">
                <div class="sacred-card">
                    <div class="sacred-card-header">
                        <h3><i class="fa fa-shopping-bag"></i> Sacred Offerings</h3>
                    </div>
                    <div class="sacred-card-body" style="padding: 0; overflow-x: auto;">
                        <table class="sacred-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $srNo = 1; @endphp
                                @forelse($orderItems as $item)
                                <tr>
                                    <td>{{ $srNo++ }}</td>
                                    <td>{{ $item->categoryName ?? '—' }}</td>
                                    <td>{{ $item->productName ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        @if(!empty($item->productImage))
                                            <img class="product-img" src="{{ url($item->productImage) }}" alt="Product Image"
                                                 onerror="this.style.display='none'">
                                        @else
                                            <span style="color:#ccc;">—</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->quantity ?? 1 }}</td>
                                    <td>{{ $currencySymbol->value }}{{ number_format($item->unitPrice ?? 0, 2) }}</td>
                                    <td>{{ $currencySymbol->value }}{{ number_format($item->totalPrice ?? 0, 2) }}</td>
                                    <td>{{ $order->orderStatus }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="color:#b08a55; padding: 30px;">
                                        <i class="fa fa-eye"></i> No sacred offerings found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ─── Totals Section ─── --}}
            <div class="total-section">
                <div class="total-row">
                    <span class="total-label">Sub Total:</span>
                    <span class="total-value">{{ $currencySymbol->value }}{{ number_format($order->payableAmount, 2) }}</span>
                </div>
                @if(!empty($order->gstPercent) && $order->gstPercent > 0)
                <div class="total-row">
                    <span class="total-label">GST ({{ $order->gstPercent }}%):</span>
                    <span class="total-value">{{ $currencySymbol->value }}{{ $order->gstAmount }}</span>
                </div>
                @endif
                <div class="total-row grand-total-row">
                    <span class="total-label grand-total-label">Total Payable:</span>
                    <span class="total-value grand-total-value">{{ $currencySymbol->value }}{{ number_format($order->totalPayable, 2) }}</span>
                </div>
                <div class="tax-note">(inclusive of all sacred taxes)</div>
            </div>

            {{-- ─── Signatory ─── --}}
            <div class="signatory-section">
                <div class="signatory-title">For {{ ucfirst($appname) }}</div>
                <div class="signatory-title">Authorised Sacred Signatory</div>
                @if(!empty($signature->value))
                    <img class="signature-img" src="{{ url($signature->value) }}" alt="Signature">
                @else
                    <div class="signature-placeholder">[Digital Signature]</div>
                @endif
            </div>

        </div>

        {{-- ─── Footer ─── --}}
        <div class="sacred-footer">
            <p>✨ This is a system-generated sacred invoice, requiring no physical signature ✨</p>
            <p>May your spiritual journey be blessed with divine guidance</p>
            <p class="thanks-text">🙏 Thank you for your sacred offering! 🙏</p>
        </div>
    </div>
</body>
</html>