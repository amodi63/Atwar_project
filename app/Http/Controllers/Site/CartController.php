<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ShippingRequest;
use App\Models\Cart;
use App\Models\ContactInformation;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    public function addProductToCart()
    {

        if (! auth('customer')->user()->cartHasProduct(request('product_id'))) {
            Cart::create([
                'product_id' => request('product_id'),
                'customer_id' => auth('customer')->user()->id,
                'quantity' => 1,
                'status' => 0,
            ]);
            return response() -> json([
                'status' => true ,
                'msg' => __('site/site.the_product_has_been_added_to_the_cart')
            ]);
        }
        return response() -> json([
            'status' => false ,
            'msg' => __('site/site.this_product_has_been_added_a_while_ago')
        ]);
    }

    public function cart()
    {
        if (!auth('customer')->user()) {
            $notification = array(
                'message' => __('site/site.you_are_not_logged_into_the_system'),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $carts_products = auth('customer')->user()
            ->cartProduct()
            ->get();

        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();


        $total_price = 0;
        foreach ($carts_products as $cart_product){
            $total_price += $cart_product->product->price * $cart_product->quantity;
        }

        return view('site.cart', compact('carts_products', 'total_price', 'contact_information', 'useful_links', 'social_links'));
    }

    public function productUpdateQuantity(Request $request)
    {
        $customer_id = auth('customer')->user()->id;
        $cart_product = Cart::where('customer_id', $customer_id)->where('product_id', request('product_id'))
        ->update([
            'quantity' => $request->quantity
        ]);

        $carts_products = auth('customer')->user()
            ->cartProduct()
            ->get();

        $total_price = 0;

        foreach ($carts_products as $cart_product){
                $total_price += $cart_product->product->price * $cart_product->quantity;
        }




        return response()->json([
            'status' => true,
            'total_price' => $total_price,
            'msg' => __('site/site.product_quantity_has_been_updated')
        ]);
    }

    public function productDelete()
    {
        $customer_id = auth('customer')->user()->id;
        $cart_product = Cart::where('customer_id', $customer_id)->where('product_id', request('product_id'))->delete();

        $carts_products = auth('customer')->user()
            ->cartProduct()
            ->get();

        $total_price = 0;

        foreach ($carts_products as $cart_product){
            $total_price += $cart_product->product->price * $cart_product->quantity;
        }



        return response()->json([
            'status' => true,
            'total_price' => $total_price,
            'msg' => __('site/site.the_product_has_been_removed_from_the_basket')
        ]);
    }

    public function shipping (ShippingRequest $request)
    {
        DB::beginTransaction();
        $shipping = Shipping::create([
            'customer_id' => $request->customer_id,
            'first_name' => $request->first_name1,
            'last_name' => $request->last_name1,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'country' => $request->country,
            'email' => $request->email1,
        ]);

        $order = auth('customer')->user()->orders()->create([
            'total_price' => $request->price_total,
            'status' => 0,
        ]);

        $carts_products = auth('customer')->user()
            ->cartProduct()
            ->get();

        $order_id = $order['id'];

        foreach ($carts_products as $cart_product){
            auth('customer')->user()->purchases()->create([
                'order_id' => $order_id,
                'shipping_id' => $shipping->id,
                'product_id' => $cart_product->product_id,
                'quantity' => $cart_product->quantity,
            ]);
        }

        $customer_id = auth('customer')->user()->id;
        $cart_product = Cart::where('customer_id', $customer_id)->delete();

        DB::commit();

        return response()->json([
            'status' => true,
            'msg' => __('site/site.your_request_has_been_successfully_sent')
        ]);
    }
}
