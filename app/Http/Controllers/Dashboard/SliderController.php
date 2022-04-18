<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public function index(Request $request)
    {

        $images = Slider::get();
        if ($request->ajax()) {

            return DataTables::of($images)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    return '<img src="' . $row->getPhoto($row->photo) . '" border="0" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })
                ->addColumn('action', function ($row) {
                    $url = route('edit.slider', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editSlider" class="primary box-shadow-3 mb-1 editSlider" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteSlider" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);


        }
        return view('admin.sliders.index', compact('images'));
    }

    //to save images to folder only
    public function saveImagesOfSliderInFolder(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveImagesOfSliderInDB(SliderRequest $request)
    {
        // save dropzone images
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                Slider::create([
                    'photo' => $image,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.success_add_slider')
        ]);

    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        $notification = array(
            'message' => __('admin/dashboard.slider_error'),
            'alert-type' => 'error'
        );

        if (!$slider)
            return redirect()->route('index.sliders')->with($notification);

        return view('admin.sliders.edit', compact('slider'));
    }

    public function update($id, SliderRequest $request)
    {
        $slider = Slider::find($id);

        $notification = array(
            'message' => __('admin/dashboard.slider_error'),
            'alert-type' => 'error'
        );

        if (!$slider)
            return redirect()->route('index.sliders')->with($notification);

        // save dropzone images
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $slider->where('id', $id)->update([
                    'photo' => $image,
                ]);
            }
        }

        $notification = array(
            'message' => __('admin/dashboard.success_update_slider'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.sliders')->with($notification);
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $notification = array(
            'message' => __('admin/dashboard.slider_error'),
            'alert-type' => 'error'
        );

        if (!$slider){
            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.slider_error')
            ]);

        } else {
            $image_path = public_path('assets/images/admin/sliders') . '/' . $slider->photo;
            unlink($image_path);
            $slider->delete();
            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.success_delete_slider')
            ]);
        }

    }
}
