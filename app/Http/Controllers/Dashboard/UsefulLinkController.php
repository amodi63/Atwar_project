<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UsefulLinkRequest;
use App\Models\UsefulLink;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class UsefulLinkController extends Controller
{
    public function index(Request $request)
    {
        $useful_links = UsefulLink::all();
        if ($request->ajax()) {

            return DataTables::of($useful_links)
                ->addIndexColumn()

                ->editColumn('name', function ($row){
                    return $row->name;
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.useful_links', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editUsefulLink" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteUsefulLinks" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.usefulLinks.index');
    }

    public function store(UsefulLinkRequest $request)
    {
        DB::beginTransaction();

        $useful_link = new UsefulLink;

        $useful_link->link = $request->link;

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $useful_link->setTranslations('name', $translations_name);

        $useful_link->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_useful_link_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $useful_link = UsefulLink::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_useful_link_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$useful_link)
            return redirect()->route('index.useful_links')->with($notification);

        return view('admin.usefulLinks.edit', compact('useful_link'));
    }

    public function update($id, UsefulLinkRequest $request)
    {
        $useful_link = UsefulLink::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_useful_link_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$useful_link)
            return redirect()->route('index.useful_links')->with($notification);

        DB::beginTransaction();

        $useful_link->where('id', $id)->update([
           'link' => $request->link
        ]);

        $translations_name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $useful_link->setTranslations('name', $translations_name);

        $useful_link->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.useful_link_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.useful_links')->with($notification);
    }

    public function destroy($id)
    {

        $useful_link = UsefulLink::find($id);

        if (!$useful_link) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_useful_link_is_not_available'),
            ]);
        } else {

            $useful_link->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.useful_link_has_been_successfully_deleted'),
            ]);


        }


    }
}
