@extends('../layout/' . $layout)

@section('subhead')
    <title>Order Detail #{{ $order->id }}</title>
@endsection

@section('subcontent')
@php
    $currSym = $currency->value ?? '\u20b9';
@endphp

<div class="loader"></div>

{{-- Page header --}}
<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">
        Order Detail &nbsp;
        <span class="text-slate-500 font-normal text-base">#{{ $order->id }}</span>
    </h2>
    <a href="{{ route('orders') }}" class="btn btn-secondary shadow-md">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Back to Orders
    </a>
</div>

<div class="intro-y grid grid-cols-12 gap-5 mt-5">

    {{-- \u2500\u2500\u2500 LEFT COLUMN \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
    <div class="col-span-12 lg:col-span-8">

        {{-- Products / Items card --}}
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-3">
                <i data-lucide="shopping-bag" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Products Ordered</h3>
                <span class="ml-auto text-slate-500 text-sm">
                    {{ count($orderItems) }} item(s)
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-bordered" style="min-width:460px;">
                    <thead>
                        <tr class="bg-slate-100 dark:bg-darkmode-800">
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Product</th>
                            <th class="text-center whitespace-nowrap">Category</th>
                            <th class="text-center whitespace-nowrap">Qty</th>
                            <th class="text-center whitespace-nowrap">Unit Price</th>
                            <th class="text-center whitespace-nowrap">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $idx => $item)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 image-fit zoom-in mr-3 flex-shrink-0">
                                        <img class="rounded-full"
                                             src="{{ Str::startsWith($item->productImage ?? '', ['http://','https://'])
                                                    ? $item->productImage
                                                    : '/' . ($item->productImage ?? '') }}"
                                             onerror="this.onerror=null;this.src='/build/assets/images/person.png';"
                                             alt="{{ $item->productName }}">
                                    </div>
                                    <span class="font-medium">{{ $item->productName }}</span>
                                </div>
                            </td>
                            <td class="text-center">{{ $item->categoryName ?? '-' }}</td>
                            <td class="text-center">{{ $item->quantity ?? 1 }}</td>
                            <td class="text-center">{{ $currSym }}{{ number_format($item->unitPrice ?? 0, 2) }}</td>
                            <td class="text-center font-medium">{{ $currSym }}{{ number_format($item->totalPrice ?? 0, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right font-medium">Subtotal:</td>
                            <td class="text-center font-medium">{{ $currSym }}{{ number_format($order->payableAmount ?? 0, 2) }}</td>
                        </tr>
                        @if($order->gstPercent > 0)
                        <tr>
                            <td colspan="5" class="text-right text-slate-500">GST ({{ $order->gstPercent }}%):</td>
                            <td class="text-center text-slate-500">{{ $currSym }}{{ $order->gstAmount }}</td>
                        </tr>
                        @endif
                        @if($order->walletBalanceDeducted > 0)
                        <tr>
                            <td colspan="5" class="text-right text-success">Wallet Deducted:</td>
                            <td class="text-center text-success">- {{ $currSym }}{{ number_format($order->walletBalanceDeducted, 2) }}</td>
                        </tr>
                        @endif
                        <tr class="bg-slate-50 dark:bg-darkmode-700">
                            <td colspan="5" class="text-right font-bold">Total Payable:</td>
                            <td class="text-center font-bold text-primary">{{ $currSym }}{{ number_format($order->totalPayable ?? $order->payableAmount ?? 0, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Shipping Address card --}}
        <div class="intro-y box p-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Shipping Address</h3>
            </div>
            @if($order->addressUserName || $order->flatNo)
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <span class="text-slate-500">Recipient Name</span>
                    <div class="font-medium mt-1">{{ $order->addressUserName ?? '-' }}</div>
                </div>
                <div>
                    <span class="text-slate-500">Phone</span>
                    <div class="font-medium mt-1">
                        {{ $order->phoneNumber ?? '-' }}
                        @if($order->phoneNumber2) / {{ $order->phoneNumber2 }} @endif
                    </div>
                </div>
                <div class="col-span-2">
                    <span class="text-slate-500">Address</span>
                    <div class="font-medium mt-1">
                        {{ implode(', ', array_filter([
                            $order->flatNo,
                            $order->locality,
                            $order->landmark,
                            $order->city,
                            $order->state,
                            $order->country,
                            $order->pincode
                        ])) }}
                    </div>
                </div>
            </div>
            @else
            <p class="text-slate-500 text-sm">No address on record.</p>
            @endif
        </div>

    </div>{{-- /col-span-8 --}}

    {{-- \u2500\u2500\u2500 RIGHT COLUMN \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 --}}
    <div class="col-span-12 lg:col-span-4">

        {{-- Order Info card --}}
        <div class="intro-y box p-5 mb-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="file-text" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Order Info</h3>
            </div>
            <div class="text-sm space-y-2">
                <div class="flex justify-between">
                    <span class="text-slate-500">Order ID</span>
                    <span class="font-medium">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Date</span>
                    <span class="font-medium">{{ date('d M Y, h:i A', strtotime($order->created_at)) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Payment Method</span>
                    <span class="font-medium capitalize">{{ $order->paymentMethod ?? '-' }}</span>
                </div>
                @if($order->couponCode)
                <div class="flex justify-between">
                    <span class="text-slate-500">Coupon Used</span>
                    <span class="font-medium text-success">{{ $order->couponCode }}</span>
                </div>
                @endif
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Order Status</span>
                    <span @class([
                        'font-medium px-2 py-1 rounded text-xs',
                        'text-success bg-success/10' => $order->orderStatus == 'Confirmed' || $order->orderStatus == 'Delivered',
                        'text-danger bg-danger/10'   => $order->orderStatus == 'Pending' || $order->orderStatus == 'Cancelled',
                        'text-warning bg-warning/10' => $order->orderStatus == 'Packed' || $order->orderStatus == 'Dispatched',
                    ])>{{ $order->orderStatus }}</span>
                </div>
            </div>

            {{-- Change Status --}}
            @if($order->orderStatus && $order->orderStatus != 'Cancelled' && $order->orderStatus != 'Delivered')
            <div class="mt-4 pt-3 border-t border-slate-200 dark:border-darkmode-400">
                <label class="form-label text-xs text-slate-500 mb-1">Change Status</label>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm w-full dropdown-toggle"
                            aria-expanded="false" data-tw-toggle="dropdown">
                        <span id="currentStatusLabel">{{ $order->orderStatus }}</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 ml-auto"></i>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            @foreach(['Confirmed','Packed','Dispatched','Delivered','Cancelled'] as $s)
                            <li>
                                <a href="javascript:;"
                                   class="dropdown-item {{ $s=='Cancelled' ? 'text-danger' : ($s=='Confirmed'||$s=='Delivered' ? 'text-success' : '') }}"
                                   onclick="changeStatus({{ $order->id }},'{{ $s }}',{{ $order->userId }})"
                                   data-tw-target="#status-change" data-tw-toggle="modal">
                                    {{ $s }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            {{-- Invoice Download --}}
            <div class="mt-3">
                <a target="_blank"
                   href="{{ route('order.invoice', ['id' => $order->id]) }}"
                   class="btn btn-primary w-full">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                    Download Invoice
                </a>
            </div>
        </div>

        {{-- Customer Info card --}}
        <div class="intro-y box p-5">
            <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-3 mb-4">
                <i data-lucide="user" class="w-5 h-5 mr-2 text-primary"></i>
                <h3 class="font-medium text-base">Customer</h3>
            </div>
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 image-fit flex-shrink-0">
                    <img class="rounded-full w-12 h-12 object-cover"
                         src="{{ Str::startsWith($order->userProfileImage ?? '', ['http://','https://'])
                                ? $order->userProfileImage
                                : '/' . ($order->userProfileImage ?? '') }}"
                         onerror="this.onerror=null;this.src='/build/assets/images/person.png';">
                </div>
                <div>
                    <div class="font-medium">{{ $order->userName }}</div>
                    <div class="text-slate-500 text-xs">{{ $order->userEmail ?? '' }}</div>
                </div>
            </div>
            <div class="text-sm space-y-2">
                <div class="flex items-center gap-2">
                    <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                    <span>{{ $order->userContactNo ?? '-' }}</span>
                </div>
            </div>
        </div>

    </div>{{-- /col-span-4 --}}
</div>

{{-- Status change confirmation modal --}}
<div id="status-change" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="check-circle" class="w-16 h-16 text-success mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are You Sure?</div>
                    <div class="text-slate-500 mt-2" id="active">You want change Status!</div>
                </div>
                <form action="{{ route('changeOrder') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="userId" name="userId">
                    <input type="hidden" id="status" name="status">
                    <div class="px-5 pb-8 text-center">
                        <button class="btn btn-primary mr-3" id="btnActive">Yes, Change it!</button>
                        <a type="button" data-tw-dismiss="modal" class="btn btn-secondary w-24">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function changeStatus(orderId, status, userId) {
        $("#id").val(orderId);
        $("#status").val(status);
        $("#userId").val(userId);
        document.getElementById('active').innerHTML = "You want to change status to <strong>" + status + "</strong>";
    }

    $(window).on('load', function () {
        $('.loader').hide();
    });
</script>
@endsection