<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\ContactInformation;
use App\Models\Product;
use App\Models\SocialLink;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        if ($request->fromHeaderProduct){
            session(['fromHeaderProduct' => true]);
        }else{
            session(['fromHeaderProduct' => false]);
        }
        $paginate = 6;
        if (request('paginate')){
            $paginate = $request->paginate;
        }

        $categories = Category::get();
        $companies = Company::get();
        $products = Product::paginate($paginate);
        $all_products = Product::get();
        $product_max_price = Product::max('price');
        $contact_information = ContactInformation::first();
        $useful_links = UsefulLink::get();
        $social_links = SocialLink::get();

        if ($request->ajax()) {

                $input_category_id = $request->input('categories');
              //  dd($input_category_id);
                if ($request->input('categories'))
                    $input_category_id = array_map('intval',$input_category_id);
                else $input_category_id = [];

                $input_company_id = $request->input('companies');
                if ($request->input('companies'))
                    $input_company_id = array_map('intval',$input_company_id);
                else $input_company_id = [];


                $min_price =intval($request->min_val);
                $max_price = intval($request->max_val);
                $product_max_price = Product::max('price');

                if ($request->min_val >= 0 && $request->max_val <= $product_max_price){
                    $min_price = intval($request->min_val);
                    $max_price =  intval($request->max_val);
                }else{
                    $min_price = 0;
                    $max_price = $product_max_price;
                }
                $products = Product::with(['category', 'company'])->when(count($input_category_id) > 0 , function ($query) use ($input_category_id){
                    return $query->whereIn('category_id',$input_category_id);

                })->when(count($input_company_id) > 0 , function ($query) use ($input_company_id) {
                    return $query->whereIn('company_id', $input_company_id);

                })->when($min_price >= 0 && $max_price <= $product_max_price , function ($query) use ($request){
                    return  $query->where('price', '>', $request->min_val)->where('price', '<=', $request->max_val);
                })->paginate($paginate);


            return view('site._shopPaginate', compact('products'));
        }

        return view('site.shop' , compact('products', 'categories', 'companies', 'product_max_price', 'all_products', 'contact_information', 'useful_links', 'social_links'));

    }


    public function shopFilter(Request $request)
    {
        $paginate = 3;
        if (request('paginate')){
            $paginate = $request->paginate;
        }
        $input_category_id = $request->input('categories');
        if ($request->input('categories'))
            $input_category_id = array_map('intval',$input_category_id);
        else $input_category_id = [];

        $input_company_id = $request->input('companies');
        if ($request->input('companies'))
            $input_company_id = array_map('intval',$input_company_id);
        else $input_company_id = [];


        $min_price =intval($request->min_val);
        $max_price = intval($request->max_val);
        $product_max_price = Product::max('price');

        if ($request->min_val >= 0 && $request->max_val <= $product_max_price){
            $min_price = intval($request->min_val);
            $max_price =  intval($request->max_val);
        }else{
            $min_price = 0;
            $max_price = $product_max_price;
        }

         $products = Product::with(['category', 'company'])->when(count($input_category_id) > 0 , function ($query) use ($input_category_id){
            return $query->whereIn('category_id',$input_category_id);

        })->when(count($input_company_id) > 0 , function ($query) use ($input_company_id) {
             return $query->whereIn('company_id', $input_company_id);

         })->when($min_price >= 0 && $max_price <= $product_max_price , function ($query) use ($request){
             return  $query->where('price', '>', $request->min_val)->where('price', '<=', $request->max_val);
         })->paginate($paginate);


        return view('site._shopFillter', compact('products'));

    }

    public function productDetails($id)
    {
        $product = Product::find($id);

        $contact_information = ContactInformation::first();
        $social_links = SocialLink::get();
        $useful_links = UsefulLink::get();

        if (!$product){
            $notification = array(
                'message' => __('site/site.this_product_is_not_available'),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $product_categories_id =  $product->category_id;
        $products_related = Product::with('category')->when($product_categories_id, function ($query) use ($product_categories_id){
                $query->where('category_id', $product_categories_id);
        })-> limit(6) -> latest() ->get();


        return view('site.product-details', compact('product', 'products_related', 'contact_information', 'useful_links', 'social_links'));
    }
}
