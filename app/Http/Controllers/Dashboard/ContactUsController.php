<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    public function index (Request $request)
    {
       $contact_us = ContactUs::get();

        if ($request->ajax()) {

            return DataTables::of($contact_us)
                ->addIndexColumn()

                ->make(true);


        }

        return view('admin.contacts.index');
    }
}
