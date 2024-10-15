<?php

namespace App\Http\Controllers;

use App\Http\AllTraits\MyTrait;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class BlogController extends Controller
{
    use MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Blogs';
        $res['items'] = Blog::orderBy('id', 'DESC')->get();
        return view('admin.blogs.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res['title'] = 'Create Blog';
        $res['cats'] = SubCategory::orderBy('sub_category', 'ASC')->get();
        return view('admin.blogs.create', $res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $count = Blog::count();
        $url = $this->make_url($request->title);
         if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = date('ymdhis').$file->getClientOriginalName();
            $file->move(public_path('assets/img/'), $filename);
        }else{
            $filename = 'na';
        }
        $data = [
            'meta_key' => $request->meta_key,
            'meta_desc' => $request->meta_desc,
            'sub_category_id' => $request->sub_category_id,
            'title' =>  (string) $request->title,
            'url' => $url,
            'image' => $filename,
            'description' => $request->description,
            'created_at' => date('Y-m-d H:i:s')
        ];
        if (Blog::insert($data)) {
            return redirect()->back()->with('success', 'Blog Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog, $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $res['title'] = 'Edit Blog';
        $res['blog'] = $blog;
        return view('admin.blogs.edit', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = date('ymdhis').$file->getClientOriginalName();
            $file->move(public_path('assets/img/'), $filename);
        }else{
            $filename = $request->himage;
        }

        $data = [
            'meta_key' => $request->meta_key,
            'meta_desc' => $request->meta_desc,
            'title' => $request->title,
            'image' => $filename,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if (Blog::where('id', $blog->id)->update($data)) {
            return redirect()->back()->with('success', 'Blog Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if (Blog::where('id', $blog->id)->delete()) {
            return redirect()->back();
        }
    }
}
