<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ContactInformationRequest;
use App\Models\ContactInformation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ContactInformationController extends Controller
{
    public function index (Request $request)
    {
        $contact_informations = ContactInformation::get();

        if ($request->ajax()) {

            return DataTables::of($contact_informations)
                ->addIndexColumn()

                ->editColumn('address', function ($row){
                    return $row->address;
                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.contact_information', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editContactInformation" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteContactInformation" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.contactInformation.index');
    }

    public function store(ContactInformationRequest $request)
    {
        DB::beginTransaction();


        $contact_information = new  ContactInformation;

        $contact_information->phone = $request->phone;

        $contact_information->email = $request->email;

        $translations_address = [
             'en' => $request->address_en,
             'ar' => $request->address_ar,
         ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $contact_information->setTranslations('address', $translations_address);
        $contact_information->setTranslations('description', $translations_description);
        $contact_information->save();


        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_contact_information_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $contact_information = ContactInformation::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_contact_information_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$contact_information)
            return redirect()->route('index.contact_information')->with($notification);

        return view('admin.contactInformation.edit', compact('contact_information'));
    }

    public function update($id, ContactInformationRequest $request)
    {
        $contact_information = ContactInformation::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_contact_information_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$contact_information)
            return redirect()->route('index.contact_information')->with($notification);

        DB::beginTransaction();


        $contact_information->update([
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $translations_address = [
            'en' => $request->address_en,
            'ar' => $request->address_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $contact_information->setTranslations('address', $translations_address);
        $contact_information->setTranslations('description', $translations_description);
        $contact_information->save();



        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.contact_information_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.contact_information')->with($notification);
    }

    public function destroy($id)
    {
        $contact_information = ContactInformation::find($id);

        if (!$contact_information) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_contact_information_is_not_available'),
            ]);
        } else {

            $contact_information->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.contact_information_has_been_successfully_deleted'),
            ]);
        }


    }
}
