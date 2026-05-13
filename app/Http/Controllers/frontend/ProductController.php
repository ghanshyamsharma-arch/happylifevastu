<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\SystemFlag;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getproducts(Request $request)
    {
        Artisan::call('cache:clear');
        $getproductCategory = Http::withoutVerifying()->post(url('/') . '/api/getproductCategory')->json();

        $productCategoryId = (int)$request->productCategoryId;
        $searchTerm        = $request->input('s');

        $getsystemflag = SystemFlag::all();
        $currency      = $getsystemflag->where('name', 'currencySymbol')->first();

        $productlist = Product::query();
        if ($request->productCategoryId) {
            $productlist->where('productCategoryId', '=', $request->productCategoryId);
        }
        $productlist = $productlist->where('isActive', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('frontend.pages.products', [
            'getproductCategory' => $getproductCategory,
            'productCategoryId'  => $productCategoryId,
            'searchTerm'         => $searchTerm,
            'currency'           => $currency,
            'productlist'        => $productlist,
        ]);
    }

    public function getproductDetails(Request $request)
    {
        Artisan::call('cache:clear');

        $getproductdetails = Product::join('product_categories', 'product_categories.id', '=', 'astromall_products.productCategoryId')
            ->where('astromall_products.slug', '=', $request->slug)
            ->select('astromall_products.*', 'product_categories.name as productCategory')
            ->first();

        if (!$getproductdetails) abort(404);

        if (isset($request->ref)) {
            setcookie('productref_' . $getproductdetails->id, $request->ref, time() + (1440 * 60), "/");
        }

        $productfaq    = DB::table('product_details')->where('astromallProductId', $getproductdetails->id)->get();
        $getsystemflag = SystemFlag::all();
        $currency      = $getsystemflag->where('name', 'currencySymbol')->first();
        $productlist   = Product::query()->where('isActive', 1)->where('id', '!=', $getproductdetails->id)->orderBy('created_at', 'desc')->take(4)->get();

        return view('frontend.pages.product-details', [
            'getproductdetails' => $getproductdetails,
            'currency'          => $currency,
            'productlist'       => $productlist,
            'productfaq'        => $productfaq,
        ]);
    }
 public function checkout(Request $request)
    {
        Artisan::call('cache:clear');
        
        // ══════════ Check authentication ══════════
        if (!authcheck()) {
            return redirect()->route('front.home');
        }
        
        $userId = authcheck()['id'];
        
        // ══════════ Get token from multiple sources ══════════
        $token = '';
        
        if (session()->has('token')) {
            $token = session()->get('token');
        }
        
        if (empty($token)) {
            $session = new Session();
            $token = $session->get('token');
        }
        
        if (empty($token) && function_exists('authcheck')) {
            $user = authcheck();
            if (isset($user['token'])) {
                $token = $user['token'];
            }
        }
        
        // ══════════ Load cart items ══════════
        $cartItems = CartItem::with('product')->where('userId', $userId)->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('front.cart')->with('error', 'Your cart is empty.');
        }
        
        // ══════════ Load saved addresses - WITH FULL NULL SAFETY ══════════
        $getOrderAddress = [];
        
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->post(url('/') . '/api/getOrderAddress', [
                    'userId' => $userId,
                    'token'  => $token,
                ])
                ->json();
            
            // ✅ Validate response structure
            if (!empty($response) && is_array($response)) {
                $getOrderAddress = $response;
            }
        } catch (\Exception $e) {
            Log::error('getOrderAddress API error', [
                'userId' => $userId,
                'error' => $e->getMessage()
            ]);
        }
        
        // ✅ Ensure recordList key exists
        if (empty($getOrderAddress) || !is_array($getOrderAddress)) {
            $getOrderAddress = ['recordList' => []];
        }
        
        if (!isset($getOrderAddress['recordList'])) {
            $getOrderAddress['recordList'] = [];
        }
        
        // ✅ Ensure recordList is an array
        if (!is_array($getOrderAddress['recordList'])) {
            $getOrderAddress['recordList'] = [];
        }
        
        // ══════════ Get country and state data for form ══════════
        $countries = DB::table('countries2')->get();
        $countries2 = DB::table('countries')
            ->orderByRaw("CASE WHEN phonecode = 91 THEN 0 ELSE 1 END")
            ->get();
        
        // ══════════ Get system flags ══════════
        $getsystemflag = SystemFlag::all();
        $gstvalue      = $getsystemflag->where('name', 'Gst')->first();
        $currency      = $getsystemflag->where('name', 'currencySymbol')->first();
        
        // ══════════ Calculate totals ══════════
        $subtotal = 0;
        
        foreach ($cartItems as $item) {
            if ($item->product) {
                try {
                    $rawAmount = $item->product->getRawOriginal('amount');
                    $subtotal += (float)$rawAmount * $item->quantity;
                } catch (\Exception $e) {
                    Log::warning('Error calculating item price', [
                        'itemId' => $item->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }
        
        // ══════════ Calculate GST and total ══════════
        $gstPercent = 0;
        if ($gstvalue && !empty($gstvalue->value)) {
            $gstPercent = (float)$gstvalue->value;
        }
        
        $gstAmount = $subtotal * ($gstPercent / 100);
        $total = $subtotal + $gstAmount;
        
        // ══════════ Return view with all data ══════════
        return view('frontend.pages.checkout', [
            'cartItems'       => $cartItems,
            'getOrderAddress' => $getOrderAddress,      // ✅ Safe - guaranteed to have recordList
            'countries'       => $countries,
            'countries2'      => $countries2,
            'gstvalue'        => $gstvalue,
            'currency'        => $currency,
            'token'           => $token,
            'subtotal'        => $subtotal,
            'gstAmount'       => $gstAmount,
            'gstPercent'      => $gstPercent,
            'total'           => $total,
        ]);
    }

    public function myOrders(Request $request)
    {
        Artisan::call('cache:clear');

        if (!authcheck()) return redirect()->route('front.home');

        $userId = authcheck()['id'];

        $token = '';
        if (session()->has('token')) {
            $token = session()->get('token');
        }
        if (empty($token)) {
            $session = new Session();
            $token   = $session->get('token');
        }

        $currency = SystemFlag::where('name', 'currencySymbol')->first();
        $coinIcon = SystemFlag::where('name', 'coinIcon')->value('value') ?? '';
        $walletType = SystemFlag::where('name', 'walletType')->value('value') ?? 'currency';

        // Load orders with items
        $orders = DB::table('order_request as o')
            ->where('o.userId', $userId)
            ->where('o.orderType', 'astromall')
            ->orderBy('o.id', 'desc')
            ->get();

        // Attach order items + address to each order
        foreach ($orders as $order) {
            // Get all order items
            $order->items = DB::table('order_items as oi')
                ->join('astromall_products as p', 'p.id', '=', 'oi.productId')
                ->where('oi.orderId', $order->id)
                ->select('oi.*', 'p.name as productName', 'p.productImage')
                ->get();

            // Fallback for legacy single-product orders
            if ($order->items->isEmpty() && $order->productId) {
                $product = DB::table('astromall_products')->where('id', $order->productId)->first();
                if ($product) {
                    $order->items = collect([(object)[
                        'productName'  => $product->name,
                        'productImage' => $product->productImage,
                        'quantity'     => 1,
                        'unitPrice'    => $order->payableAmount,
                        'totalPrice'   => $order->payableAmount,
                    ]]);
                }
            }

            // Get first item for display (for backwards compatibility)
            $order->productName = $order->items->first()?->productName ?? '-';
            $order->productImage = $order->items->first()?->productImage ?? '';

            $order->address = DB::table('order_addresses')->where('id', $order->orderAddressId)->first();
            
            // Generate invoice link
            $order->invoice_link = route('order.invoice', ['id' => $order->id]);
        }

        return view('frontend.pages.my-orders', compact('orders', 'currency', 'token', 'coinIcon', 'walletType'));
    }

    public function manualPayment($orderId)
    {
        Artisan::call('cache:clear');

        if (!authcheck()) return redirect()->route('front.home');

        $order = DB::table('order_request')->where('id', $orderId)->first();
        if (!$order) abort(404, 'Order not found');

        $user     = DB::table('users')->where('id', $order->userId)->first();
        $currency = SystemFlag::where('name', 'currencySymbol')->first();

        // Multi-item support
        $orderItems = DB::table('order_items as oi')
            ->join('astromall_products as p', 'p.id', '=', 'oi.productId')
            ->where('oi.orderId', $orderId)
            ->select('oi.*', 'p.name as productName', 'p.productImage')
            ->get();

        // Fallback for legacy single-product orders
        $product = null;
        if ($orderItems->isEmpty() && $order->productId) {
            $product = DB::table('astromall_products')->where('id', $order->productId)->first();
        }

        return view('frontend.pages.manual-payment', compact('order', 'user', 'product', 'orderItems', 'currency'));
    }
}