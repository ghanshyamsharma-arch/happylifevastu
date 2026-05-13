<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\AdminModel\SystemFlag;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getUserId()
    {
        $user = authcheck();
        return $user ? $user['id'] : null;
    }

    /**
     * Add item to cart (AJAX)
     */
    public function addToCart(Request $request)
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return response()->json([
            'success' => false,
            'login_required' => true,
            'message' => 'Please login first'
            ]);
        }

        $request->validate([
            'productId' => 'required|exists:astromall_products,id',
            'quantity'  => 'nullable|integer|min:1|max:99',
        ]);

        $qty = $request->quantity ?? 1;

        $cartItem = CartItem::where('userId', $userId)
            ->where('productId', $request->productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = min($cartItem->quantity + $qty, 99);
            $cartItem->save();
        } else {
            CartItem::create([
                'userId'    => $userId,
                'productId' => $request->productId,
                'quantity'  => $qty,
            ]);
        }

        $cartCount = CartItem::where('userId', $userId)->sum('quantity');

        return response()->json([
            'success'    => true,
            'message'    => 'Item added to cart!',
            'cart_count' => $cartCount,
        ]);
    }

    /**
     * Remove item from cart (AJAX)
     */
    public function removeFromCart(Request $request)
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        CartItem::where('userId', $userId)
            ->where('productId', $request->productId)
            ->delete();

        $cartCount = CartItem::where('userId', $userId)->sum('quantity');
        $cartData  = $this->getCartData($userId);

        return response()->json([
            'success'       => true,
            'cart_count'    => $cartCount,
            'cart_total'    => $cartData['total'],
            'cart_subtotal' => $cartData['subtotal'],
        ]);
    }

    /**
     * Update item quantity (AJAX)
     */
    public function updateCart(Request $request)
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $qty = max(1, min(99, (int)$request->quantity));

        CartItem::where('userId', $userId)
            ->where('productId', $request->productId)
            ->update(['quantity' => $qty]);

        $cartCount = CartItem::where('userId', $userId)->sum('quantity');
        $cartData  = $this->getCartData($userId);

        return response()->json([
            'success'       => true,
            'cart_count'    => $cartCount,
            'cart_total'    => $cartData['total'],
            'cart_subtotal' => $cartData['subtotal'],
            'item_total'    => $this->getItemTotal($userId, $request->productId),
        ]);
    }

    /**
     * Get cart count for menu badge (AJAX)
     */
    public function getCartCount()
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return response()->json(['count' => 0]);
        }
        $count = CartItem::where('userId', $userId)->sum('quantity');
        return response()->json(['count' => $count]);
    }

    /**
     * Cart page
     */
    public function cartPage()
    {
        $userId = $this->getUserId();
        if (!authcheck()) {
return redirect()->back();
}

        // No eager loading with 'category' \u2014 just 'product'
        $cartItems = CartItem::with('product')
            ->where('userId', $userId)
            ->get();

        $getsystemflag = SystemFlag::all();
        $currency      = $getsystemflag->where('name', 'currencySymbol')->first();
        $gstvalue      = $getsystemflag->where('name', 'Gst')->first();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $subtotal += $item->product->amount * $item->quantity;
            }
        }

        $gstPercent = $gstvalue ? (float)$gstvalue->value : 0;
        $gstAmount  = $subtotal * ($gstPercent / 100);
        $total      = $subtotal + $gstAmount;

        return view('frontend.pages.cart', compact(
            'cartItems', 'currency', 'gstvalue', 'subtotal', 'gstAmount', 'total', 'gstPercent'
        ));
    }

    /**
     * Helper: cart totals
     */
    private function getCartData($userId)
    {
        $cartItems  = CartItem::with('product')->where('userId', $userId)->get();
        $gstPercent = (float)(SystemFlag::where('name', 'Gst')->value('value') ?? 0);

        $subtotal = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $subtotal += $item->product->amount * $item->quantity;
            }
        }
        $gstAmount = $subtotal * ($gstPercent / 100);
        return [
            'subtotal' => number_format($subtotal, 2),
            'total'    => number_format($subtotal + $gstAmount, 2),
        ];
    }

    private function getItemTotal($userId, $productId)
    {
        $item = CartItem::with('product')
            ->where('userId', $userId)
            ->where('productId', $productId)
            ->first();
        if (!$item || !$item->product) return 0;
        return number_format($item->product->amount * $item->quantity, 2);
    }
    public function getOrderSuccess($orderId)
    {
        try {
            $order = \App\Models\UserModel\UserOrder::with('orderAddress')->find($orderId);
            
            if (!$order) {die;
                return redirect()->route('front.home')->with('error', 'Order not found');
            }

            // Get order items
            $orderItems = \DB::table('order_items')
                ->where('orderId', $orderId)
                ->get();

            // Get product details for each item
            $items = [];
            $gstAmount = 0;
            $subtotal = 0;

            foreach ($orderItems as $item) {
                $product = \DB::table('astromall_products')->find($item->productId);
                if ($product) {
                    $items[] = [
                        'name' => $product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->unitPrice,
                        'total' => $item->quantity * $item->unitPrice
                    ];
                    $subtotal += $item->quantity * $item->unitPrice;
                }
            }

            // Calculate GST
            $gstPercent = $order->gstPercent ?? 18;
            $gstAmount = ($subtotal * $gstPercent) / 100;

            return view('pages.order-success', [
                'order' => $order,
                'items' => $items,
                'subtotal' => $subtotal,
                'gstAmount' => $gstAmount,
                'gstPercent' => $gstPercent,
                'totalAmount' => $order->totalPayable
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();die;
            return redirect()->route('front.home')->with('error', $e->getMessage());
        }
    }
}