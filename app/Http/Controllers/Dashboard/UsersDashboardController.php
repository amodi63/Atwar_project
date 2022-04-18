<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UsersDashboardRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsersDashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = Admin::where('id', '!=', 1)->get();

        if ($request->ajax()) {

            return DataTables::of($users)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $url = route('edit.user', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editUser" class="primary box-shadow-3 mb-1 editUser" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteUser" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.usersDashboard.index');
    }

    public function store(UsersDashboardRequest $request)
    {
        $filePath = '';
        if ($request->has('image')){
            $filePath = uploadImage('profile', $request->image);
        }
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $filePath
        ]);

        $user->save();

        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_user_has_been_successfully_added')
        ]);


    }

    public function edit($id)
    {
        $user = Admin::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_user_is_not_available'),
            'alert-type' => 'error'
        );
        if (!$user)
            return redirect()->route('index.users')->with($notification);

        return view('admin.usersDashboard.edit', compact('user'));
    }

    public function update($id, UsersDashboardRequest $request)
    {
        $user = Admin::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_user_is_not_available'),
            'alert-type' => 'error'
        );
        if (!$user)
            return redirect()->route('index.users')->with($notification);

        if ($request->has('image')) {
            $image_path = public_path('assets/images/admin/profile/') . $user->image;
            if ($user->image != 'logo.png') {
                unlink($image_path);
            }
            $filePath = uploadImage('profile', $request->image);
            $user->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $filePath,
            ]);

        }

        $user->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $notification = array(
            'message' => __('admin/dashboard.user_updated_successfully'),
            'alert-type' => 'info'
        );

        return redirect()->route('index.users')->with($notification);
    }

    public function destroy(Request $request)
    {

        $user = Admin::find($request->id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_user_is_not_available'),
            ]);
        } else {
            $user->delete();
            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.user_has_been_successfully_deleted'),
            ]);
        }


    }
}
