<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Http\Requests\CartRequest;
use App\Http\Requests\GiftRequest;
use App\Http\Requests\ServiceCartRequest;
use App\Http\Resources\AddressResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceCart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class ServiceCartRepository extends Repository
{
    public static function model()
    {
        return ServiceCart::class;
    }

    public static function wiseCartProducts($isBuyNow)
    {
        // Fetch service carts with eager loading of the related service
        $carts = auth()->user()->customer->service_carts()
            ->where('is_buy_now', $isBuyNow)
            ->with('service') // Ensure there's a 'service' relationship defined in your ServiceCart model
            ->get();
    
        // Process the cart items to include service data
        $serviceCarts = $carts->map(function ($cart) {
            $service = Service::find($cart->service_id);
            return [
                'id' => $cart->id,
                'customer_id' => $cart->customer_id,
                'quantity' => $cart->quantity,
                'is_buy_now' => (bool) $cart->is_buy_now, // Cast to boolean if needed
                'created_at' => $cart->created_at->toISOString(), // Format to ISO 8601
                'updated_at' => $cart->updated_at->toISOString(), // Format to ISO 8601
                'service' => $cart->service_id ? array_merge(
                    $service->toArray(),
                    [
                        'thumbnail' => ($service->media_id && $service->media && $service->media->src)
                            ? Storage::url($service->media->src)
                            : null,
                    ]
                ) : null,
            ];
        });
    
        \Log::info("Wise cart products : " . $serviceCarts);

        return $serviceCarts; // Return the processed collection
    }
    
    /**
     * Store or update cart by request.
     */
    public static function storeOrUpdateByRequest(ServiceCartRequest $request,     Service $service): ServiceCart
    {

        $isBuyNow = $request->is_buy_now ?? false;

        $customer = auth()->user()->customer;

        $cart = $customer->service_carts()?->where('service_id', $service->id)->where('is_buy_now', $isBuyNow)->first();

        if ($cart) {
            $cart->update([
                'quantity' =>  1, //$cart->quantity +
            ]);

            return $cart;
        }

        return self::create([
            'service_id' => $request->service_id,
            'is_buy_now' => $isBuyNow,
            'customer_id' => $customer->id,
            'quantity' => $request->quantity ?? 1,
        ]);
    }

    public static function checkoutByRequest($request, $carts)
    {
        $totalAmount = 0;
        $giftCharge = 0;
        $couponDiscount = 0;
        $payableAmount = 0;

        if (! $carts->isEmpty()) {

            foreach ($carts as $cart) {
                $price = $cart->service->discounted_price > 0 ? $cart->service->discounted_price : $cart->service->price;
                $totalAmount += $price * $cart->quantity;
              
            }


            $couponDiscount = 0;

            $totalAmount += $giftCharge;

            $payableAmount = $totalAmount  - $couponDiscount;
        }

        \Log::info("Checkout : " . $totalAmount . $giftCharge . $couponDiscount . $payableAmount);
        return [
            'total_amount' => (float) round($totalAmount, 2),
            'delivery_charge' => (float) round(0.0, 2),
            'coupon_discount' => (float) round($couponDiscount, 2),
            'payable_amount' => (float) round($payableAmount, 2),
            'gift_charge' => (float) round($giftCharge, 2),
        ];
    }

    public static function giftAddToCart(GiftRequest $request, Cart $cart): Cart
    {
        $cart->update([
            'gift_id' => $request->gift_id,
            'gift_receiver_name' => $request->receiver_name,
            'gift_sender_name' => $request->sender_name ?? auth()->user()->name,
            'gift_note' => $request->note,
            'address_id' => $request->address_id,
        ]);

        return $cart;
    }

    public static function giftDeleteToCart($request)
    {
        $cart = self::find($request->cart_id);

        if ($cart) {
            $cart->update([
                'gift_id' => null,
                'gift_receiver_name' => null,
                'gift_sender_name' => null,
                'gift_note' => null,
                'address_id' => null,
            ]);
        }

        return $cart;
    }
}
