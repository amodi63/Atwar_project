<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CoordinatesRequest;
use App\Models\Coordinates;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class CoordinatesController extends Controller
{
    public function index(Request $request)
    {
        $coordinates = Coordinates::all();
        if ($request->ajax()) {

            return DataTables::of($coordinates)
                ->addIndexColumn()

                ->editColumn('address', function ($row){
                    return $row->address;
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.coordinates', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCoordinates" class="primary box-shadow-3 mb-1 editCompany" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteCoordinates" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.coordinates.index');
    }

    public function store(CoordinatesRequest $request)
    {
        DB::beginTransaction();
        $coordinate = new Coordinates;

        $coordinate->longitude = $request->longitude;
        $coordinate->latitude = $request->latitude;

        $translations_address = [
            'en' => $request->address_en,
            'ar' => $request->address_ar,
        ];

        $coordinate->setTranslations('address', $translations_address);

        $coordinate->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_coordinate_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $coordinate = Coordinates::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_coordinate_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$coordinate)
            return redirect()->route('index.coordinates')->with($notification);

        return view('admin.coordinates.edit', compact('coordinate'));
    }

    public function update($id, CoordinatesRequest $request)
    {
        $coordinate = Coordinates::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_coordinate_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$coordinate)
            return redirect()->route('index.coordinates')->with($notification);

        DB::beginTransaction();

        $coordinate->update([
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);


        $translations_address = [
            'en' => $request->address_en,
            'ar' => $request->address_ar,
        ];

        $coordinate->setTranslations('address', $translations_address);

        $coordinate->save();


        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.coordinate_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.coordinates')->with($notification);
    }

    public function destroy($id)
    {

        $coordinate = Coordinates::find($id);
        if (!$coordinate) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_coordinate_is_not_available'),
            ]);
        } else {
            $coordinate->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.coordinate_has_been_successfully_deleted'),
            ]);
        }


    }
}
