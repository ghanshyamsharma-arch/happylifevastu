@extends('frontend.layout.master')
@section('subhead')
    <title>Order Complete</title>
@endsection


@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Success Message -->
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <i class="fa-solid fa-check-circle" style="font-size: 2.5rem; color: #28a745;"></i>
                <h2 class="mt-3 mb-2">Order Confirmed!</h2>
                <p class="mb-0">Thank you for your order. Your payment has been successfully processed.</p>
            </div>

            <!-- Order Details Card -->
            <div class="card mt-4 mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Order Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                            <p><strong>Order Date:</strong> {{ date('d M Y, H:i A', strtotime($order->created_at)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Order Status:</strong> 
                                <span class="badge badge-success">{{ $order->orderStatus ?? 'Confirmed' }}</span>
                            </p>
                            <p><strong>Payment Method:</strong> {{ $order->paymentMethod ?? 'Online' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Summary -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Products Ordered</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <th>Product Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td class="text-center">{{ $item['quantity'] }}</td>
                                <td class="text-right">₹{{ number_format($item['price'], 2) }}</td>
                                <td class="text-right">₹{{ number_format($item['total'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Price Summary -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Price Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-8 text-right">
                            <strong>Subtotal:</strong>
                        </div>
                        <div class="col-md-4 text-right">
                            <strong>₹{{ number_format($subtotal, 2) }}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8 text-right">
                            <strong>GST ({{ $gstPercent }}%):</strong>
                        </div>
                        <div class="col-md-4 text-right">
                            <strong>₹{{ number_format($gstAmount, 2) }}</strong>
                        </div>
                    </div>
                    <div class="row" style="border-top: 2px solid #dee2e6; padding-top: 1rem;">
                        <div class="col-md-8 text-right">
                            <h5 class="mb-0" style="color: #28a745;">Amount Paid:</h5>
                        </div>
                        <div class="col-md-4 text-right">
                            @php
                            $totalAmount=$subtotal+$gstAmount;
                            @endphp
                            <h5 class="mb-0" style="color: #28a745;">₹{{ number_format($totalAmount, 2) }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            @if ($order->orderAddress)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Shipping Address</h5>
                </div>
                <div class="card-body">
                    <p><strong>{{ $order->orderAddress->name }}</strong></p>
                    <p>{{ $order->orderAddress->flatNo }}, {{ $order->orderAddress->locality }}</p>
                    <p>{{ $order->orderAddress->landmark }}</p>
                    <p>Pincode: {{ $order->orderAddress->pincode }}</p>
                    <p>Phone: +{{ $order->orderAddress->countryCode }} {{ $order->orderAddress->phoneNumber }}</p>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="row mt-4 mb-4">
                <div class="col-md-6 mb-2">
                    <a href="{{ route('front.home') }}" class="btn btn-primary btn-block">
                        <i class="fa-solid fa-home"></i> Continue Shopping
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button class="btn btn-success btn-block" id="whatsappShare">
                        <i class="fa-brands fa-whatsapp"></i> Share on WhatsApp
                    </button>
                </div>
            </div>

            <!-- Additional Info -->
            <!--<div class="alert alert-info mt-4" role="alert">-->
            <!--    <h5><i class="fa-solid fa-info-circle"></i> Next Steps</h5>-->
            <!--    <ul class="mb-0 mt-2">-->
            <!--        <li>You will receive a confirmation email shortly</li>-->
            <!--        <li>Track your order from "My Orders" section</li>-->
            <!--        <li>Expected delivery in 5-7 business days</li>-->
            <!--        <li>Contact us for any queries regarding your order</li>-->
            <!--    </ul>-->
            <!--</div>-->
        </div>
    </div>
</div>

 <script>
document.getElementById('whatsappShare').addEventListener('click', function() {

    const orderNumber = '{{ $order->id }}';

    const productsList = `{{ implode("\n", array_map(function($item) {
        return $item['quantity'] . ' x ' . $item['name'] . ' - ₹' . number_format($item['total'], 2);
    }, $items)) }}`;

    const message = `Hello! I have completed the payment for Order #${orderNumber}.

Product(s):
${productsList}

Subtotal: ₹{{ number_format($subtotal, 2) }}
GST ({{ $gstPercent }}%): ₹{{ number_format($gstAmount, 2) }}
Amount Paid: ₹{{ number_format($totalAmount, 2) }}

Please verify and confirm my order. Thank you!`;

    // Proper URL Encoding
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;

    window.open(whatsappUrl, '_blank');
});
</script>
<style>
    .card {
        border: none;
        border-radius: 0.5rem;
    }
    
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    
    .btn {
        border-radius: 0.5rem;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
    }
    
    .badge {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
</style>
@endsection
