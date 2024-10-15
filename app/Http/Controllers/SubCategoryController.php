<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\AllTraits\MyTrait;

class SubCategoryController extends Controller
{
    use MyTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Sub Category';
        $res['categories'] = Category::all();
        $res['items'] = SubCategory::join('categories', 'categories.id', '=' , 'sub_categories.category_id')->select(['sub_categories.*', 'categories.category'])->get();

        return view('admin.subcategory.index', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'sub_category' => 'required|unique:sub_categories,sub_category'
        ]);
        $url = $this->make_url($request->sub_category);
        $data = [
           'url' => $url,
           'category_id' => $request->category_id,
           'sub_category' => $request->sub_category,
           'created_at' => date('Y-m-d H:i:s')
        ];
        $check = SubCategory::where([  'category_id' => $request->category_id,
           'sub_category' => $request->sub_category])->first();
        if(!$check){
            if(SubCategory::insert($data)){
                return redirect()->back()->with('success', 'Added Successfully');
            }
            
        }else{
             return redirect()->back()->with('error', 'Duplicate')->withInput();
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
