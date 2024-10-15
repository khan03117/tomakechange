<?php

namespace App\Http\Controllers;

use App\Models\ContactDetail;
use App\Models\Gallery;
use App\Models\Policy;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['title'] = 'List of Gallery Images';
        $res['items'] = Gallery::orderBy('id', 'DESC')->where('is_shown', '1')->where('type', 'gallery')->get();
        return view('frontend.gallery', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New Gallery Image";
        $items = Gallery::orderBy('id', 'DESC')->paginate(50);
        $res = compact('title', 'items');
         return view('admin.gallery.index', $res);
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
             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);
        $file = $request->file('image');
        $filename = time().$file->getClientOriginalName();
        $file->move(public_path('images/'), $filename);
        
        $data = [
            'image' => url('public/images/').'/'.$filename,
            'type' => $request->type,
            'title' => $request->title,
            'created_at' => date('Y-m-d H:i:s')
            ];
        if(Gallery::insert($data)){
            return redirect()->back()->with('success', 'Uploaded Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery, $id)
    {
        $gallery = Gallery::where('id', $id)->first();
        $data = [
            'title' => $request->title ?? $gallery->title,
            'updated_at' => date('Y-m-d H:i:s')
            ];
        if($request->file('image')){
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path('images/'), $filename);
            $data['image'] = url('public/images/').'/'.$filename;
        }
        if(Gallery::where('id', $id)->update($data)){
            return redirect()->back()->with('success', 'Uploaded updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, $id)
    {
       
        Gallery::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Uploaded Successfully');
    }
}
