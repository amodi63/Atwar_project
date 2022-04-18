<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class SocialLinkController extends Controller
{
    public function index(Request $request)
    {
        $social_links = SocialLink::all();
        if ($request->ajax()) {

            return DataTables::of($social_links)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })
                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->photo) . '" border="0" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.social_link', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editSocialLink" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteSocialLink" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);

        }
        return view('admin.socialLink.index');
    }

    public function store(SocialLinkRequest $request)
    {
        DB::beginTransaction();
        $filePath = '';
        if ($request->has('photo')){
            $filePath = uploadImage('socialLink', $request->photo);
        }
        $social_link = new SocialLink;

        $social_link->link = $request->link;
        $social_link->photo = $filePath;
        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $social_link->setTranslations('name', $translations_name);

        $social_link->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_social_link_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $social_link = SocialLink::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_social_link_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$social_link)
            return redirect()->route('index.social_link')->with($notification);

        return view('admin.socialLink.edit', compact('social_link'));
    }

    public function update($id, SocialLinkRequest $request)
    {
        $social_link = SocialLink::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_social_link_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$social_link)
            return redirect()->route('index.social_link')->with($notification);

        DB::beginTransaction();

        $filePath = '';
        if ($request->has('photo')){
            $image_path = public_path('assets/images/admin/socialLink/') . $social_link->photo;
            unlink($image_path);

            $filePath = uploadImage('socialLink', $request->photo);

            $social_link->where('id', $id)->update([
                'photo' => $filePath
            ]);
        }

        $social_link->where('id', $id)->update([
            'link' => $request->link
        ]);

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $social_link->setTranslations('name', $translations_name);

        $social_link->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.social_link_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.social_link')->with($notification);
    }

    public function destroy($id)
    {

        $social_link = SocialLink::find($id);

        if (!$social_link) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_social_link_is_not_available'),
            ]);
        } else {
            $image_path = public_path('assets/images/admin/socialLink') . '/' . $social_link->photo;
            unlink($image_path);
            $social_link->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.social_link_has_been_successfully_deleted'),
            ]);


        }


    }
}
