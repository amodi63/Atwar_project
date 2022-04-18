<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function redirectLogin()
    {
        return redirect()->route('admin.login.page');
    }


    public function checkLogin(LoginRequest $request)
    {
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $notification = array(
                'message' => __('admin/login.you_are_logged_in_successfully'),
                'alert-type' => 'success'
            );
            return redirect()->route('admin.dashboard')->with($notification);
        }

        $notification = array(
            'message' => __('admin/login.error_login'),
            'alert-type' => 'error'
        );

        return redirect() -> back()->with($notification);
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $guard->logout();

        $notification = array(
            'message' => __('admin/login.signed_out_successfully'),
            'alert-type' => 'success'
        );
        return redirect() ->route('admin.login.page')->with($notification);
    }

    private function getGuard()
    {
        return auth('admin');
    }
}
