<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $cred = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt($cred)) {
            $type = Auth::user()->designation;
            if ($type == 'Expert') {
                return redirect()->to('expert/dashboard');
            } else if ($type == 'Admin') {
                return redirect()->to('admin/dashboard');
            }
        }
    }
}
