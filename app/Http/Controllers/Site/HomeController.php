<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\ContactInformation;
use App\Models\MainPartner;
use App\Models\NewsTap;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $sliders = Slider::get();
        $news_taps = NewsTap::get();
        $about_us  = AboutUs::first();
        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();

        $our_partners = Partner::parent()->get();
        $main_partners = MainPartner::get();

        return view('site.home', compact('sliders','news_taps', 'about_us', 'contact_information','our_partners', 'main_partners', 'useful_links', 'social_links'));
    }

    public function openModal (Request $request)
    {
        $our_partner1 = Partner::parent()->where('id', $request->our_partner)->first();

        $content_partners = Partner::child()->where('parent_id', $our_partner1->id)->get();


        return view('site._partnerModal', compact('our_partner1', 'content_partners'));




    }


}
