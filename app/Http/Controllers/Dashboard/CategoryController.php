<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->ajax()) {

            return DataTables::of($categories)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })

                ->addColumn('is_active', function ($row) {
                    return $row->is_active == 1 ? __('admin/dashboard.active') : __('admin/dashboard.not_active');
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.category', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editCategory" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteCategory" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.categories.index');
    }

    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        $category = new Category();

        if (!$request->has('is_active')) {
            $request->request->add(['is_active' => 0]);

        } else {
            $request->request->add(['is_active' => 1]);

        }

        $category->is_active = $request->is_active;

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $category->setTranslations('name', $translations_name);

        $category->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_category_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_category_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$category)
            return redirect()->route('index.category')->with($notification);

        return view('admin.categories.edit', compact('category'));
    }

    public function update($id, CategoryRequest $request)
    {
        $category = Category::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_category_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$category)
            return redirect()->route('index.category')->with($notification);

        DB::beginTransaction();
        if (!$request->has('is_active')) {
            $request->request->add(['is_active' => 0]);

        } else {
            $request->request->add(['is_active' => 1]);

        }

        $category->update([
            'is_active' => $request->is_active,
        ]);

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $category->setTranslations('name', $translations_name);

        $category->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.category_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.category')->with($notification);
    }

    public function destroy($id)
    {

        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_category_is_not_available'),
            ]);
        } else {
            if ( count($category->products) > 0){
                return response()->json([
                    'status' => false,
                    'msg' => __('admin/dashboard.this_category_can_not_be_deleted_has_products_associated_with_it'),
                ]);
            }

            else{
                $category->delete();

                return response()->json([
                    'status' => true,
                    'msg' => __('admin/dashboard.category_blog_has_been_successfully_deleted'),
                ]);
            }

        }


    }
}
