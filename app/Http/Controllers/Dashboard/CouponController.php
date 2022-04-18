<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::get();
        $products = Product::select('id', 'name')->get();

        if ($request->ajax()) {

            return DataTables::of($coupons)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    return $row->type == 1 ? __('admin/dashboard.percentage') : __('admin/dashboard.fixed_value');
                })

                ->addColumn('products', function ($row) {
                    return \GuzzleHttp\json_decode($row->products->map(function ($products){
                        return $products->name;
                    }));
                })
                ->editColumn('end_datetime', function ($row) {
                    return $row->end_datetime;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $status = '<input type="checkbox" name="status" value="1" id="switcheryColor4"
                       class="switchery active is_active" data-id="' . $row->id . '" data-color="success" checked >';
                    } else {
                        $status = '<input type="checkbox" name="status" value="0" id="switcheryColor4"
                       class="switchery active is_active" data-id="' . $row->id . '" data-color="success" >';
                    }

                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $url = route('edit.coupon', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editCopon" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteCopon" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'status','end_datetime'])
                ->make(true);


        }
        return view('admin.coupons.index', compact('coupons', 'products'));
    }

    public function store(CouponRequest $request)
    {
        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }

        $coupons = Coupon::get();
        foreach ($coupons as $cop){
            foreach ($cop->products as $product){
                foreach ($request->products as $pro){
                    if ($product->id == $pro){
                        return response()->json([
                            'msg' => __('admin/dashboard.this_product_was_added_before'),
                            'status' => false,
                        ]);

                    }
                }

            }
        }

        DB::beginTransaction();
        $coupon = Coupon::create([
            'code' => $request->code,
            'type' => $request->type,
            'percent_discount' => $request->percent_discount,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status,
        ]);

        $coupon->products()->attach($request->products);

        $coupon->save();

        DB::commit();
        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_coupon_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $data = [];
         $coupon = Coupon::find($id);
        $data['products'] = Product::select('id', 'name')->get();
        $notification = array(
            'message' => __('admin/dashboard.the_coupon_is_not_available'),
            'alert-type' => 'error'
        );
        if (!$coupon)
            return redirect()->route('index.coupon')->with($notification);

        $coupon_products = collect();
        foreach ($coupon->products as $products){
            $coupon_products []= $products;

        }

        return view('admin.coupons.edit', compact('coupon', 'coupon_products'), $data);
    }

    public function update($id, CouponRequest $request)
    {
        $coupon = Coupon::find($id);
        $notification = array(
            'message' => __('admin/dashboard.the_coupon_is_not_available'),
            'alert-type' => 'error'
        );
        if (!$coupon)
            return redirect()->route('index.coupons')->with($notification);

        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }
        $coupons = Coupon::get();
        foreach ($coupons as $cop){
            foreach ($cop->products as $product){
                foreach ($request->products as $product_request){
                    foreach ($coupon->products as $coupon_product){
                        if ($coupon_product->id != $product_request){
                            if ($product->id == $product_request){
                                $notification = array(
                                    'message' => __('admin/dashboard.this_product_was_added_before'),
                                    'alert-type' => 'error'
                                );

                                return redirect()->back()->with($notification);
                            }

                        }
                    }

                }

            }
        }

        DB::beginTransaction();
        $coupon->where('id', $id)->update([
            'code' => $request->code,
            'type' => $request->type,
            'percent_discount' => $request->percent_discount,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status,
        ]);

        $coupon->products()->sync($request->products);

        DB::commit();
        $notification = array(
            'message' => __('admin/dashboard.coupon_updated_successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('index.coupon')->with($notification);
    }

    public function destroy($id)
    {

        $coupon = Coupon::find($id);
        if (!$coupon) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_coupon_is_not_available'),
            ]);
        } else {
            $coupon->delete();
            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.coupon_has_been_successfully_deleted'),
            ]);
        }


    }

    public function updateStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->coupon_id);
        $coupon->status = $request->status;
        $coupon->save();

        $notification = array(
            'msg' => __('admin/dashboard.status_updated_successfully'),
            'alert-type' => 'info'
        );

        return response()->json($notification);
    }
}
