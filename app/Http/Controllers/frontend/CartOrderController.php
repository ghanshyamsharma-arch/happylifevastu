<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\UserModel\UserOrder;
use App\Models\AdminModel\SystemFlag;
use App\Models\UserModel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartOrderController extends Controller
{
    /**
     * Place order from cart (multi-item)
     */
    public function placeOrder(Request $request)
    {
        try {
            if (!authcheck()) {
                return response()->json(['error' => 'Unauthorized', 'status' => 401], 401);
            }

            $userId = authcheck()['id'];

            $request->validate([
                'orderAddressId' => 'required',
                'paymentMethod'  => 'required',
            ]);

            $cartItems = CartItem::with('product')->where('userId', $userId)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Cart is empty', 'status' => 400], 400);
            }

            $gstvalue   = SystemFlag::where('name', 'Gst')->first();
            $gstPercent = $gstvalue ? (float)$gstvalue->value : 0;
            $inrRate    = DB::table('systemflag')->where('name', 'UsdtoInr')->value('value') ?? 1;

            $subtotal = 0;
            foreach ($cartItems as $item) {
                if ($item->product) {
                    $subtotal += $item->product->getRawOriginal('amount') * $item->quantity;
                }
            }
            $gstAmount = $subtotal * ($gstPercent / 100);
            $total     = $subtotal + $gstAmount;

            // International users: convert
            $user    = User::find($userId);
            $isIndia = ($user->countryCode ?? '+91') == '+91';
            if (!$isIndia) {
                $subtotal  = $subtotal / $inrRate;
                $gstAmount = $gstAmount / $inrRate;
                $total     = $total / $inrRate;
            }

            DB::beginTransaction();

            $firstItem = $cartItems->first();

            $order = new UserOrder();
            $order->userId            = $userId;
            $order->productCategoryId = $firstItem->product->productCategoryId;
            $order->productId         = $firstItem->productId;
            $order->orderAddressId    = $request->orderAddressId;
            $order->payableAmount     = $subtotal;
            $order->gstPercent        = $gstPercent;
            $order->totalPayable      = $total;
            $order->paymentMethod    = $request->paymentMethod;
            $order->orderType         = 'astromall';
            $order->orderStatus       = 'Pending';
            $order->inr_usd_conversion_rate = $inrRate;
            $order->created_at        = now();
            $order->updated_at        = now();
            $order->save();

            // Save each cart item as order item
            foreach ($cartItems as $item) {
                if (!$item->product) continue;
                OrderItem::create([
                    'orderId'           => $order->id,
                    'productId'         => $item->productId,
                    'productCategoryId' => $item->product->productCategoryId,
                    'quantity'          => $item->quantity,
                    'unitPrice'         => $item->product->getRawOriginal('amount'),
                    'totalPrice'        => $item->product->getRawOriginal('amount') * $item->quantity,
                ]);
            }

            // Clear cart after order placed
            CartItem::where('userId', $userId)->delete();

            DB::commit();

            return response()->json([
                'message'  => 'Order placed successfully',
                'order_id' => $order->id,
                'status'   => 200,
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage(), 'status' => 500], 500);
        }
    }
}