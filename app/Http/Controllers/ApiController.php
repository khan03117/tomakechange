<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function add_appointment(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|max:10'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors(),
                'success' => "0",
                "message" => $validate->errors()->first()
            ]);
        } else {

            $data = $request->except('_token');

            $resp = Lead::insert($data);
            return response()->json([
                'data' => $resp,
                'success' => "1",

                "message" => "Appointment request sent."
            ]);
        }
    }
}
