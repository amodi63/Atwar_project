<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Yajra\DataTables\Facades\DataTables;
use DB;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::all();
        if ($request->ajax()) {

            return DataTables::of($blogs)
                ->addIndexColumn()

                ->editColumn('title', function ($row){
                    return $row->title;
                })

                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->photo) . '" border="0" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.blog', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editBlog" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteBlog" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);

        }
        return view('admin.blog.index');
    }

    public function store(BlogRequest $request)
    {
        DB::beginTransaction();
        $filePath = '';
        if ($request->has('photo')){
            $filePath = uploadImage('blog', $request->photo);
        }

        $blog = new Blog;
        $blog->photo = $filePath;

        $translations_title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $blog->setTranslations('title', $translations_title);
        $blog->setTranslations('description', $translations_description);

        $blog->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => __('admin/dashboard.the_blog_has_been_successfully_added')
        ]);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_blog_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$blog)
            return redirect()->route('index.blog')->with($notification);

        return view('admin.blog.edit', compact('blog'));
    }

    public function update($id, BlogRequest $request)
    {
        //return $request;
        $blog = Blog::find($id);

        $notification = array(
            'message' => __('admin/dashboard.the_blog_is_not_available'),
            'alert-type' => 'error'
        );

        if (!$blog)
            return redirect()->route('index.blog')->with($notification);

        DB::beginTransaction();

        $filePath = '';
        if ($request->has('photo')){
            $image_path = public_path('assets/images/admin/blog/') . $blog->photo;
            unlink($image_path);

            $filePath = uploadImage('blog', $request->photo);

            $blog->update([
                'photo' => $filePath
            ]);
        }

        $translations_title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $translations_description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $blog->setTranslations('title', $translations_title);
        $blog->setTranslations('description', $translations_description);

        $blog->save();
        DB::commit();

        $notification = array(
            'message' => __('admin/dashboard.blog_updated_successfully'),
            'alert-type' => 'info'
        );


        return redirect()->route('index.blog')->with($notification);
    }

    public function destroy($id)
    {

        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json([
                'status' => false,
                'msg' => __('admin/dashboard.the_blog_is_not_available'),
            ]);
        } else {
            $image_path = public_path('assets/images/admin/blog') . '/' . $blog->photo;
            unlink($image_path);
            $blog->delete();

            return response()->json([
                'status' => true,
                'msg' => __('admin/dashboard.the_blog_has_been_successfully_deleted'),
            ]);
        }


    }
}
