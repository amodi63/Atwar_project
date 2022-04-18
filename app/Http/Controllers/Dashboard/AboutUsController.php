<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutUsRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $about_us = AboutUs::all();
        if ($request->ajax()) {

            return DataTables::of($about_us)
                ->addIndexColumn()

                ->editColumn('title', function ($row){
                    return $row->title;
                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.about_us', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editAbout" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteAboutUs" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'title'])
                ->make(true);

        }
        return view('admin.aboutus.index');
    }

    public function store(AboutUsRequest $request)
    {
        DB::beginTransaction();
        $about_us = new AboutUs;

        $translations_title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $about_us->setTranslations('title', $translations_title);
        $about_us->setTranslations('description', $translations_description);

        $about_us->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_about_us_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $about_us = AboutUs::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_about_us_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$about_us)
            return redirect()->route('index.about')->with($notification);

        return view('admin.aboutus.edit', compact('about_us'));
    }

    public function update($id, AboutUsRequest $request)
    {
        //return $request;
        $about_us = AboutUs::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_about_us_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$about_us)
            return redirect()->route('index.about')->with($notification);

        DB::beginTransaction();
        $translations_title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $about_us->setTranslations('title', $translations_title);
        $about_us->setTranslations('description', $translations_description);

        $about_us->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.about_us_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.about_us')->with($notification);
    }

    public function destroy($id)
    {

        $about_us = AboutUs::find($id);
        if (!$about_us) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_about_us_is_not_available'),
            ]);
        } else {
            $about_us->delete();

            return response()->json([
                'status' => true,
                'msg' =>__('admin/dashboard.the_about_us_has_been_successfully_deleted'),
            ]);
        }


    }
}
