<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Http\Requests\Site\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function checkLoginCustomer(LoginRequest $request)
    {
        $remember_me = $request->has('remember') ? true : false;
        if (auth()->guard('customer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)){
//            $customer = Customer::where('id', auth()->guard('customer')->user()->id)->update([
//                'remember_token' => $request->remember_token
//            ]);
            return response()->json([
                'msg' => __('site/site.you_are_logged_in_successfully'),
                'status' => true
            ]);
        }


        return response()->json([
            'msg' => __('site/site.there_is_an_error_in_the_data_please_check'),
            'status' => false
        ]);

    }

    public function registerCustomer(CustomerRequest $request)
    {
        if($request->has('terms_conditions')){
            $customer = Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $customer->save();


//            $notification = array(
//                'message' => 'تم اضافتك كعميل في االمتجر',
//                'alert-type' => 'success'
//            );

            return response()->json([
                'msg' => __('site/site.you_have_been_added_as_a_customer_in_the_store'),
                'status' => true
            ]);


        }else{
//            $notification = array(
//                'message' => 'فشلت عملية اضافة العميل',
//                'alert-type' => 'error'
//            );
            return response()->json([
                'msg' => __('site/site.addition_failed'),
                'status' => false
            ]);
        }
    }

    public function logout()
    {
        if (! auth('customer')->user()){
            $notification = array(
                'message' => __('site/site.you_are_not_logged_into_the_system'),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $guard = $this->getGuard();
        $guard->logout();

        $notification = array(
            'message' => __('site/site.signed_out_successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);
    }

    private function getGuard()
    {
        return auth('customer');
    }
}
