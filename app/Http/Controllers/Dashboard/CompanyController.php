<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::all();
        if ($request->ajax()) {

            return DataTables::of($companies)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.company', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editCompany" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteCompany" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.company.index');
    }

    public function store(CompanyRequest $request)
    {
        DB::beginTransaction();
        $company = new Company;

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $company->setTranslations('name', $translations_name);

        $company->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_company_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $company = Company::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_company_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$company)
            return redirect()->route('index.company')->with($notification);

        return view('admin.company.edit', compact('company'));
    }

    public function update($id, CompanyRequest $request)
    {
        $company = Company::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_company_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$company)
            return redirect()->route('index.company')->with($notification);

        DB::beginTransaction();

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $company->setTranslations('name', $translations_name);

        $company->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.company_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.company')->with($notification);
    }

    public function destroy($id)
    {

        $company = Company::find($id);
        if (!$company) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_company_is_not_available'),
            ]);
        } else {

            if ( count($company->products) > 0){
                return response()->json([
                    'status' => false,
                    'msg' => __('admin/dashboard.this_company_can_not_be_deleted_has_products_associated_with_it'),
                ]);

            } else {
                $company->delete();

                return response()->json([
                    'status' => true,
                    'msg' => __('admin/dashboard.company_blog_has_been_successfully_deleted'),
                ]);
            }

        }


    }
}
