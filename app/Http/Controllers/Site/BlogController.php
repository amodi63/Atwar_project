<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactInformation;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::get();
        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();
        return view('site.blog', compact('blogs', 'contact_information', 'useful_links', 'social_links'));
    }

    public function blogDetails($id)
    {
        $blog = Blog::find($id);
        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();

        $notification = array(
            'message' => __('admin/dashboard.the_blog_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$blog)
            return redirect()->route('blog')->with($notification);

        return view('site.blogDetails', compact('blog', 'contact_information', 'useful_links', 'social_links'));
    }
}
