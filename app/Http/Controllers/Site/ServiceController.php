<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function service()
    {
        $services = Service::get();
        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();
        return view('site.service', compact('services', 'contact_information', 'useful_links', 'social_links'));
    }

    public function serviceDetails($id)
    {
        $service = Service::find($id);

        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();

        $notification = array(
            'message' => __('admin/dashboard.the_service_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$service)
            return redirect()->route('service')->with($notification);

        return view('site.serviceDetails', compact('service', 'contact_information', 'useful_links', 'social_links'));
    }
}
