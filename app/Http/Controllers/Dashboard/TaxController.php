<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TaxRequest;
use App\Models\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        $taxes = Tax::all();
        if ($request->ajax()) {

            return DataTables::of($taxes)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.tax', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editTax" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteTax" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.tax.index');
    }

    public function store(TaxRequest $request)
    {
        DB::beginTransaction();
        $tax = new Tax;

        $tax->amount = $request->amount;

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $tax->setTranslations('name', $translations_name);

        $tax->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_tax_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $tax = Tax::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_tax_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$tax)
            return redirect()->route('index.tax')->with($notification);

        return view('admin.tax.edit', compact('tax'));
    }

    public function update($id, TaxRequest $request)
    {
        $tax = Tax::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_tax_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$tax)
            return redirect()->route('index.tax')->with($notification);

        DB::beginTransaction();

        $tax->update([
            'amount' => $request->amount
        ]);

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $tax->setTranslations('name', $translations_name);

        $tax->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.tax_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.tax')->with($notification);
    }

    public function destroy($id)
    {

        $tax = Tax::find($id);

        if (!$tax) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_tax_is_not_available'),
            ]);
        } else {
            $tax->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.tax_has_been_successfully_deleted'),
            ]);
        }


    }
}
