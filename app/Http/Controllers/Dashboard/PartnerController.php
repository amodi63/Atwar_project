<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumeration\PartnerType;
use App\Http\Requests\Dashboard\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $partners = Partner::all();
        $our_partners = Partner::parent()->get();
        if ($request->ajax()) {

            return DataTables::of($partners)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })

                ->editColumn('parent_id', function ($row){
                    return $row->_parent->name ?? '--';
                })


                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->photo) . '" border="0" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.partner', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editPartner" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deletePartner" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);

        }
        return view('admin.partners.index',compact('our_partners'));
    }

    public function store(PartnerRequest $request)
    {
        DB::beginTransaction();
        $filePath = '';
        if ($request->has('photo')){
            $filePath = uploadImage('partners', $request->photo);
        }

        $partner = new Partner;
        $partner->photo = $filePath;
        if ($request->type == PartnerType::ourPartner) {  // type = 1 . mean add our Partner. >>>> if type = 2 . mean add main Partner
            $request->request->add(['parent_id' => null]);

        }

        $partner->parent_id = $request->parent_id;
        $partner->link = $request->link;

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $translations_description = [];
        if ($request->description_ar && $request->description_en){
            $translations_description = [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ];

        }




        $partner->setTranslations('name', $translations_name);
        $partner->setTranslations('description', $translations_description);

        $partner->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'partner' => $partner,
            'msg' => __('admin/dashboard.the_partner_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $partner = Partner::find($id);

        $our_partners = Partner::parent()->get();

        $notification = array(
            'message' => __('admin/dashboard.the_partner_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$partner)
            return redirect()->route('index.partner')->with($notification);

        return view('admin.partners.edit', compact('partner', 'our_partners'));
    }

    public function update($id, PartnerRequest $request)
    {
        $partner = Partner::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_partner_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$partner)
            return redirect()->route('index.partner')->with($notification);

        DB::beginTransaction();

        $filePath = '';
        if ($request->has('photo')){
            $image_path = public_path('assets/images/admin/partners/') . $partner->photo;
            unlink($image_path);

            $filePath = uploadImage('partners', $request->photo);

            if ($request->type == PartnerType::ourPartner) {  // type = 1 . mean add our Partner. >>>> if type = 2 . mean add main Partner
                $request->request->add(['parent_id' => null]);
            }

            $partner->update([
                'photo' => $filePath,
            ]);
        }

        $partner->update([
            'parent_id' => $request->parent_id,
            'link' => $request->link,
        ]);
        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $translations_description = [];
        if ($request->description_ar && $request->description_en){
            $translations_description = [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ];
        }


        $partner->setTranslations('name', $translations_name);
        $partner->setTranslations('description', $translations_description);

        $partner->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.partner_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.partner')->with($notification);
    }

    public function destroy($id)
    {

        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_partner_is_not_available'),
            ]);
        } else {
            if ($partner->parent_id == null)
            {
                return response()->json([
                    'status' => false,
                    'msg' => __('admin/dashboard.this_partner_cannot_be_deleted'),
                ]);

            }else{
                $image_path = public_path('assets/images/admin/partners') . '/' . $partner->photo;
                unlink($image_path);
                $partner->delete();

                return response()->json([
                    'status' => true,
                    'msg' => __('admin/dashboard.partner_has_been_successfully_deleted'),
                ]);
            }

        }


    }
}
