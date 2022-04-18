<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NewsTapRequest;
use App\Models\NewsTap;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class NewsTapController extends Controller
{
    public function index(Request $request)
    {
        $news_tap = NewsTap::all();
        if ($request->ajax()) {

            return DataTables::of($news_tap)
                ->addIndexColumn()

                ->editColumn('description', function ($row){
                    return $row->description;
                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.news_tap', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editNewsTap" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteNewsTap" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'description'])
                ->make(true);

        }
        return view('admin.newsTap.index');
    }

    public function store(NewsTapRequest $request)
    {
        DB::beginTransaction();
        $news_tap = new NewsTap;

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $news_tap->setTranslations('description', $translations_description);

        $news_tap->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_news_tap_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $news_tap = NewsTap::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_news_tap_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$news_tap)
            return redirect()->route('index.news_tap')->with($notification);

        return view('admin.newsTap.edit', compact('news_tap'));
    }

    public function update($id, NewsTapRequest $request)
    {
        $news_tap = NewsTap::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_news_tap_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$news_tap)
            return redirect()->route('index.news_tap')->with($notification);

        DB::beginTransaction();

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $news_tap->setTranslations('description', $translations_description);

        $news_tap->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.news_tap_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.news_tap')->with($notification);
    }

    public function destroy($id)
    {

        $news_tap = NewsTap::find($id);;
        if (!$news_tap) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_news_tap_is_not_available'),
            ]);
        } else {
            $news_tap->delete();

            return response()->json([
                'status' => true,
                'msg' =>__('admin/dashboard.the_news_tap_has_been_successfully_deleted'),
            ]);
        }


    }
}
