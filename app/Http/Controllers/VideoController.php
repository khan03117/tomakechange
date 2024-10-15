<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Videos';
        $res['items'] = Video::orderBy('id', 'DESC')->get();

        return view('admin.videos.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res['title'] = 'Create New Video';
        $res['cats'] = SubCategory::orderBy('sub_category', 'ASC')->get();
        return view('admin.videos.create', $res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        $urlarr = explode('/', $request->url);
        $url = 'https://www.youtube.com/embed/' . $urlarr[count($urlarr) - 1];
        $image = $request->file('image');
        $imagename = time() . $image->getClientOriginalName();
        $image->move(public_path('upload'), $imagename);
        $data = [
            'sub_category_id' => $request->category,
            'slug' => $url,
            'url' => $request->url,
            'image' => $imagename,
            'created_at' => date('Y-m-d H:i:s')
        ];
        if (Video::insert($data)) {
            return redirect()->back()->with('success', 'video uploaded successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $res['video'] = $video;
        $res['title'] = 'Edit video';
        $res['cats'] = SubCategory::orderBy('sub_category', 'ASC')->get();
        return view('admin.videos.edit', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
         $request->validate([
            'url' => 'required',
           
        ]);
        $urlarr = explode('/', $request->url);
        $url = 'https://www.youtube.com/embed/' . $urlarr[count($urlarr) - 1];
        if($request->hasFile('image')){
              $image = $request->file('image');
        $imagename = time() . $image->getClientOriginalName();
        }else{
            $imagename = $request->hfile;
        }
      
        $image->move(public_path('upload'), $imagename);
        $data = [
            'slug' => $url,
            'url' => $request->url,
            'image' => $imagename,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if (Video::where('id', $video['id'])->update($data)) {
            return redirect()->back()->with('success', 'video updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->back();
    }
}
