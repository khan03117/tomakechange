<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EndCategory;
use App\Http\AllTraits\MyTrait;
use Illuminate\Http\Request;

class EndCategoryController extends Controller
{
    use MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Child Categories';
        $res['items'] = EndCategory::join('categories', 'categories.id', '=', 'end_categories.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'end_categories.sub_category_id')
        ->select(['end_categories.*', 'categories.category', 'sub_categories.sub_category'])->get();
        return view('admin.endcategory.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res['title'] = 'Create New Child Category';
        $res['categories'] = Category::all();
        return view('admin.endcategory.create', $res);
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
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'end_category' => 'required'
        ]);
        $url = $this->make_url($request->end_category.md5($request->category_id.$request->sub_category_id));
        $data = [
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'end_category' => $request->end_category,
            'url' => $url
        ];
        if(EndCategory::insert($data)){
            return redirect()->back()->with('success', 'End Category Added Successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
