<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactUsRequest;
use App\Models\ContactInformation;
use App\Models\ContactUs;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function contactUs()
    {
         $contacts_informations = ContactInformation::get();
         $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();
        return view('site.contact', compact('contacts_informations', 'contact_information', 'useful_links', 'social_links'));
    }

    public function sendContactUs(ContactUsRequest $request)
    {
        $contact = ContactUs::create([
           'customer_id' => $request->customer_id,
           'subject' => $request->subject,
           'name' => $request->name,
           'email' => $request->email1,
           'description' => $request->description,
        ]);

        $contact->save();

        return response()->json([
            'status' => true,
           'msg' => __('site/site.your_message_was_sent_successfully')
        ]);
    }
}
