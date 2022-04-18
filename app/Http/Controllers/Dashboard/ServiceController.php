<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();
        if ($request->ajax()) {

            return DataTables::of($services)
                ->addIndexColumn()

                ->editColumn('title', function ($row){
                    return $row->title;
                })

                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->photo) . '" border="0" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.service', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editService" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteService" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);

        }
        return view('admin.service.index');
    }

    public function store(ServiceRequest $request)
    {
        DB::beginTransaction();
        $filePath = '';
        if ($request->has('photo')){
            $filePath = uploadImage('service', $request->photo);
        }

        $service = new Service;
        $service->photo = $filePath;

        $translations_title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $translations_short_description = [
            'en' => $request->short_description_en,
            'ar' => $request->short_description_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $service->setTranslations('title', $translations_title);
        $service->setTranslations('short_description', $translations_short_description);
        $service->setTranslations('description', $translations_description);

        $service->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_service_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $service = Service::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_service_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$service)
            return redirect()->route('index.service')->with($notification);

        return view('admin.service.edit', compact('service'));
    }

    public function update($id, ServiceRequest $request)
    {
        //return $request;
        $service = Service::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_service_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$service)
            return redirect()->route('index.service')->with($notification);

        DB::beginTransaction();

        $filePath = '';
        if ($request->has('photo')){
            $image_path = public_path('assets/images/admin/service/') . $service->photo;
            unlink($image_path);

            $filePath = uploadImage('service', $request->photo);

            $service->update([
                'photo' => $filePath
            ]);
        }

        $translations_title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $translations_short_description = [
            'en' => $request->short_description_en,
            'ar' => $request->short_description_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $service->setTranslations('title', $translations_title);
        $service->setTranslations('short_description', $translations_short_description);
        $service->setTranslations('description', $translations_description);

        $service->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.service_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.service')->with($notification);
    }

    public function destroy($id)
    {

        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_service_is_not_available'),
            ]);
        } else {
            $image_path = public_path('assets/images/admin/service') . '/' . $service->photo;
            unlink($image_path);
            $service->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.service_blog_has_been_successfully_deleted'),
            ]);
        }


    }
}
