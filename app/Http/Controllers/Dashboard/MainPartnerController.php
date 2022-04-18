<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainPartnerRequest;
use App\Models\MainPartner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class MainPartnerController extends Controller
{
    public function index(Request $request)
    {
        $main_partners = MainPartner::all();
        if ($request->ajax()) {

            return DataTables::of($main_partners)
                ->addIndexColumn()

                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->photo) . '" border="0" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.main_partner', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editMainPartner" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteMainPartner" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);

        }
        return view('admin.mainPartners.index',compact('main_partners'));
    }

    public function store(MainPartnerRequest $request)
    {
        DB::beginTransaction();

        $filePath = '';
        if ($request->has('photo')){
            $filePath = uploadImage('mainPartners', $request->photo);
        }

        $main_partner =  MainPartner::create([
            'link' => $request->link,
            'photo' => $filePath,
        ]);

        $main_partner->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_main_partner_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $main_partner =  MainPartner::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_main_partner_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$main_partner)
            return redirect()->route('index.main_partner')->with($notification);

        return view('admin.mainPartners.edit', compact('main_partner'));
    }

    public function update($id, MainPartnerRequest $request)
    {
        $main_partner =  MainPartner::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_main_partner_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$main_partner)
            return redirect()->route('index.main_partner')->with($notification);

        DB::beginTransaction();

        $filePath = '';
        if ($request->has('photo')){
            $image_path = public_path('assets/images/admin/mainPartners/') . $main_partner->photo;
            unlink($image_path);

            $filePath = uploadImage('mainPartners', $request->photo);

            $main_partner->update([
                'photo' => $filePath,
            ]);
        }

        $main_partner->update([
            'link' => $request->link,
        ]);

        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.main_partner_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.main_partner')->with($notification);
    }

    public function destroy($id)
    {

        $main_partner =  MainPartner::find($id);
        if (!$main_partner) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_main_partner_is_not_available'),
            ]);
        } else {
            $image_path = public_path('assets/images/admin/mainPartners') . '/' . $main_partner->photo;
            unlink($image_path);
            $main_partner->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.main_partner_has_been_successfully_deleted'),
            ]);
        }


    }
}
