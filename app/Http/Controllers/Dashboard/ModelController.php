<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ModelRequest;
use App\Models\Models;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ModelController extends Controller
{
    public function index(Request $request)
    {
        $models = Models::all();
        if ($request->ajax()) {

            return DataTables::of($models)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.model', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editModels" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteModels" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.model.index');
    }

    public function store(ModelRequest $request)
    {
        DB::beginTransaction();
        $model = new Models;

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $model->setTranslations('name', $translations_name);

        $model->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_model_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $model = Models::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_model_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$model)
            return redirect()->route('index.model')->with($notification);

        return view('admin.model.edit', compact('model'));
    }

    public function update($id, ModelRequest $request)
    {
        $model = Models::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_model_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$model)
            return redirect()->route('index.model')->with($notification);

        DB::beginTransaction();

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $model->setTranslations('name', $translations_name);

        $model->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.model_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.model')->with($notification);
    }

    public function destroy($id)
    {

        $model = Models::find($id);

        if (!$model) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_model_is_not_available'),
            ]);
        } else {

            if ( count($model->products) > 0){
                return response()->json([
                    'status' => false,
                    'msg' => __('admin/dashboard.this_model_can_not_be_deleted_has_products_associated_with_it'),
                ]);

            } else {
                $model->delete();

                return response()->json([
                    'status' => true,
                    'msg' => __('admin/dashboard.model_blog_has_been_successfully_deleted'),
                ]);
            }

        }


    }
}
