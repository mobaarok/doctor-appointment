<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an authentication attempt.
     * @return Response
     */
    public function authenticate(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->only('remember');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Authentication passed...

            return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->back()
                ->withInput($request->except('password'))
                ->with("msg", "Email or password is incorrect")
                ->with('msgType', "danger");
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
