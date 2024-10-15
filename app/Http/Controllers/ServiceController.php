<?php

namespace App\Http\Controllers;

use App\Http\AllTraits\MyTrait;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Servies';
        $res['items'] = Service::all();
        // return response()->json($res['items']);
        // die;
        return view('admin.services.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res['title'] = 'Create Serivce';
        $res['categories'] = Category::all();
        return view('admin.services.create', $res);
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
            'title' => 'required',
            'category_id' => 'required'
        ]);
        $url = $this->make_url($request->title);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('assets/img/'), $filename);
        } else {
            $filename = null;
        }
        $data = [

            'title' => $request->title,
            'url' => $url,
            'description' => $request->description,
            'key_points' => $request->key_points,
            'image' => $filename,
            'category_id' => $request->category_id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        if (Service::insert($data)) {
            return redirect()->back()->with('success', 'Service Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        
          $title = 'Edit Service';
        $res = compact('service', 'title');
         $res['categories'] = Category::all();
       
        return view('admin.services.edit', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required'
        ]);
        $url = $this->make_url($request->title);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('assets/img/'), $filename);
        } else {
            $filename = $request->hfile;
        }
        $data = [

            'title' => $request->title,
            'url' => $url,
            'description' => $request->description,
            'key_points' => $request->key_points,
            'image' => $filename,
            'category_id' => $request->category_id,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if (Service::where(['id' => $service['id']])->update($data)) {
            return redirect()->back()->with('success', 'Service Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
