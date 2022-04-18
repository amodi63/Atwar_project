<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\Purchase;
use App\Models\Shipping;
use App\Models\SocialLink;
use App\Models\Tax;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function userOrder()
    {
        $customer_id = auth('customer')->user()->id;
        $orders = Purchase::where('customer_id', $customer_id)->get();
        $tax = Tax::first();
        $shipping = Shipping::where('customer_id', $customer_id)->first();
        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();

        return view('site.user-order', compact('orders', 'tax', 'shipping', 'contact_information', 'useful_links', 'social_links'));
    }
}
