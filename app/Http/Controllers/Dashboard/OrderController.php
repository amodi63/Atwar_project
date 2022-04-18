<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index (Request $request)
    {
        $orders = Purchase::get();

        $total_price = 0;
        foreach ($orders as  $order){
            $total_price += $order->product->price * $order->quantity;
        }

        if ($request->ajax()) {

            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->order->id;
                })

                ->addColumn('customer', function ($row) {
                    return $row->customer->first_name .' '. $row->customer->last_name ;
                })

                ->addColumn('product', function ($row) {
                    return $row->product->name;
                })

                ->addColumn('created_at', function ($row) {
                   return date('d-m-Y', strtotime($row->created_at));
                })

                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })

                ->addColumn('price', function ($row) {
                    return $row->product->price;
                })

                ->addColumn('total_price', function ($row) {
                    return $row->product->price * $row->quantity;
                })

                ->addColumn('status', function ($row) {
                    $class = '';
                    $class1 = '';
                    if ($row->order->status == 0) {
                        $class = 'hidden';

                    } else {
                        $class1 = 'hidden';
                    }

                    return $status = '<td>
                        <a href="javascript:void(0)"  data-toggle="tooltip" data-status="' . $row->order->status . '"  data-id="' . $row->order->id . '" id="completed_' . $row->order->id . '"  class="btn btn-danger box-shadow-3 mb-1 '.$class1.' changeStatus" style="width: 80px">'. __('admin/dashboard.pending') .'</a>
                        <a href="javascript:void(0)"  data-toggle="tooltip" data-status="' . $row->order->status . '"  data-id="' . $row->order->id . '" id="pending_' . $row->order->id . '"  class="btn btn-success box-shadow-3 mb-1 '.$class.' changeStatus" style="width: 95px">'. __('admin/dashboard.completed') .'</a>
                        </td>';
                })

                ->addColumn('action', function ($row) {
                    $url = route('show.order', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editAbout" style="width: 80px"><i class="la la-eye font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);


        }

        return view('admin.orders.index', compact('total_price'));
    }

    public function show ($id)
    {
        $orders = Purchase::get();

        $total_price = 0;
        foreach ($orders as  $order1){
            $total_price += $order1->product->price * $order1->quantity;
        }

        $order = Purchase::with('shipping')->find($id);

        $notification = array(
            'message' => __('admin/dashboard.this_order_does_not_exist') ,
            'alert-type' => 'error'
        );

        if (!$order)
            return redirect()->route('orders')->with($notification, $total_price);

        return view('admin.orders.show', compact('order'));
    }

    public function changeStatus (Request $request)
    {
        $status = $request->status;
        $order = Order::where('id', request('order_id'))->first();
        if ($request->status == 0){
            $status = 1;
        }elseif ($request->status == 1) {
            $status = 0;
        }

        $order->where('id', request('order_id'))->update([
            'status' => $status
        ]);


        return response()->json([
            'status' => true ,
            'order_status' => $status ,
            'msg' => 'تم تحديث حالة الطلب بنجاح'
        ]);
    }
}
