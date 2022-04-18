<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Company;
use App\Models\Image;
use App\Models\Models;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();

        $categories = Category::where('is_active', 1)->get();
        $companies = Company::get();
        $models = Models::get();
        if ($request->ajax()) {

            return DataTables::of($products)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })

                ->editColumn('category_id', function ($row){
                    return $row->category->name;
                })

                ->editColumn('company_id', function ($row){
                    return $row->company->name;
                })

                ->editColumn('model_id', function ($row){
                    return $row->model->name;
                })

                ->editColumn('in_stock', function ($row){
                    return $row->in_stock == 1 ? __('admin/dashboard.available') : __('admin/dashboard.unavailable');
                })

                ->editColumn('images', function ($row){
                    $url = route('add.product.images', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="صور المنتج" id="editCustomer" class="btn btn-outline-warning box-shadow-3 mb-1 ImageProduct">'.__('admin/dashboard.image_product').'</a></td>';
                    return $btn;
                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.product', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editProduct" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteProduct" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'name', 'category_id', 'company_id', 'model_id', 'in_stock', 'images'])
                ->make(true);

        }
        return view('admin.product.index', compact('categories', 'companies', 'models'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $companies = Company::get();
        $models = Models::get();

        return view('admin.product.create', compact('categories', 'companies', 'models'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        $product = new Product;

        $product->price = $request->price;
        $product->offer = $request->offer;
        $product->category_id = $request->category_id;
        $product->company_id = $request->company_id;
        $product->model_id = $request->model_id;
        $product->sku = $request->sku;
        $product->quantity = $request->quantity;
        $product->in_stock = $request->in_stock;

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $product->setTranslations('name', $translations_name);
        $product->setTranslations('description', $translations_description);

        $product->save();

        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $image = Image::create([
                    'photo' => $image
                ]);

                $product->images()->save($image);
            }
        }

        DB::commit();


        $notification = array(
            'message' => __('admin/dashboard.the_product_has_been_successfully_added'),
            'alert-type' => 'success'
        );


        return redirect()->route('index.product')->with($notification);
//        return response()->json([
//            'status' => true,
//            'msg' => __('admin/dashboard.the_product_has_been_successfully_added')
//        ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $categories = Category::where('is_active', 1)->get();
        $companies = Company::get();
        $models = Models::get();
        $notification = array(
            'message' => __('admin/dashboard.the_product_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$product)
            return redirect()->route('index.product')->with($notification);

        return view('admin.product.edit', compact('product', 'companies', 'categories', 'models'));
    }

    public function update($id, ProductRequest $request)
    {
        $product = Product::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_product_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$product)
            return redirect()->route('index.product')->with($notification);

        DB::beginTransaction();

        $product->update([
           'price' => $request->price,
           'offer' => $request->offer,
           'category_id' => $request->category_id,
           'company_id' => $request->company_id,
           'model_id' => $request->model_id,
           'sku' => $request->sku,
           'quantity' => $request->quantity,
           'in_stock' => $request->in_stock,
        ]);
        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $product->setTranslations('name', $translations_name);
        $product->setTranslations('description', $translations_description);

        $product->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.product_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.product')->with($notification);
    }

    public function addProductImages($product_id)
    {
        $product = Product::with('images')->find($product_id);
        return view('admin.product.addImages', compact('product'));
    }

    public function saveImagesOfProductInDB(ImageRequest $request)
    {
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                Image::create([
                    'imageable_id' => $request->product_id,
                    'imageable_type' => 'App\Models\Product',
                    'photo' => $image
                ]);
            }
        }

        $notification = array(
            'message' => __('admin/dashboard.success_add_images'),
            'alert-type' => 'success'
        );
        return redirect()->route('index.product')->with($notification);


    }

    public function saveImagesOfProductInFolder(Request $request)
    {

        $image = $request->file('dzfile');
        $fileName = uploadImage('products', $image);

        return response()->json([
            'name' => $fileName,
            'original_name' => $image->getClientOriginalName(),
        ]);

    }

    public function deleteImagesOfProduct(Request $request)
    {
         $product_image = Image::find($request->image_id);
         $product = $product_image->imageable;
        $path = public_path('assets/images/admin/products/') . $product_image->photo;
        unlink($path);
        $product_image->delete();
        $image_count = count($product->images);
        return response()->json([
            'status' => true,
            'image_count' => $image_count,
            'msg' => __('admin/dashboard.the_image_has_been_deleted_successfully')
        ]);

    }

    public function destroy($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_product_is_not_available'),
            ]);
        } else {
            if (count($product -> purchases) > 0) {
                return response()->json([
                    'status' => false,
                    'msg' => __('admin/dashboard.this_product_cannot_be_deleted_It_has_orders_associated_with_it'),
                ]);

            } else {
                foreach ($product->images as $img){
                    $image_path = public_path('assets/images/admin/products/') . $img->photo;
                    unlink($image_path);
                    $img->delete();
                }
                $product->delete();

                $cart_product = Cart::where('product_id', $id)->delete();
                return response()->json([
                    'status' => true,
                    'msg' =>__('admin/dashboard.product_has_been_successfully_deleted'),
                ]);
            }

        }


    }
}
