<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\ContactInformation;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function aboutUs()
    {
        $about_us  = AboutUs::first();
        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();
        return view('site.about-us' , compact('about_us', 'contact_information', 'useful_links', 'social_links'));
    }
}
