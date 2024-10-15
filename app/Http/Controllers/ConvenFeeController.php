<?php

namespace App\Http\Controllers;

use App\Models\Conven_fee;
use Illuminate\Http\Request;

class ConvenFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res['title'] = 'Create Convenince Fee';
        return view('admin.conven_fee.create', $res);
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
            'quantity' => 'required',
            'rate' => 'required',
            'fixed_fee' => 'required',
            'mode' => 'required',
            'duration' => 'required'
        ]);
        $data = [
            'quantity' => $request->quantity,
            'rate' => $request->rate,
            'fixed_fee' => $request->fixed_fee,
            'mode' => $request->mode,
            'duration' => $request->duration
        ];
        $check = Conven_fee::where($data)->first();
        if (!$check) {
            Conven_fee::insert($data);
            return redirect()->back()->with('success', 'Convenince Fee Added');
        } else {
            return  redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conven_fee  $conven_fee
     * @return \Illuminate\Http\Response
     */
    public function show(Conven_fee $conven_fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conven_fee  $conven_fee
     * @return \Illuminate\Http\Response
     */
    public function edit(Conven_fee $conven_fee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conven_fee  $conven_fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conven_fee $conven_fee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conven_fee  $conven_fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conven_fee $conven_fee)
    {
        //
    }
}
