<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerResetPasswordController extends Controller
{
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:customer');
    }

    public function showResetForm(Request $request, $token = null)
    {

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    protected function broker()
    {
        return Password::broker('customers');
    }
}
