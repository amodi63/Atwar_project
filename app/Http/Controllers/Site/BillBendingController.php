<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class BillBendingController extends Controller
{
    public function billPending()
    {
        $customer_id = auth('customer')->user()->id;
        $orders_binding = Order::where('customer_id', $customer_id)->get();
        $contact_information = ContactInformation::first();

        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();

        $subtotal = 0;

        foreach ($orders_binding as $order_binding){
            foreach ($order_binding->purchase as $purchase_product){
                $subtotal += $purchase_product->product->price * $purchase_product->quantity;
            }
        }
        return view('site.bill-pending', compact( 'subtotal', 'orders_binding', 'contact_information','useful_links', 'social_links'));
    }
}
