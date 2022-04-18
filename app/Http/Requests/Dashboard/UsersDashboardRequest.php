<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UsersDashboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:200',
            'email' => 'required|max:150|email|unique:admins,email,'. $this -> id,
            'password' => 'required_without:id|confirmed|min:2',
            'image' => 'required_without:id|mimes:jpg,jpeg,png',

        ];
    }

    public function messages()
    {
        return[
            'name.required' => __('admin/dashboard.name.required'),
            'name.max' => __('admin/dashboard.name.max'),
            'email.required' => __('admin/dashboard.email.required'),
            'email.email' => __('admin/dashboard.email.email'),
            'email.unique' => __('admin/dashboard.email.unique'),
            'password.required_without' => __('admin/dashboard.password.required'),
            'password.min' => __('admin/dashboard.password.min'),
            'password.confirmed' => __('admin/dashboard.password.confirmed'),
            'image.required_without' => __('admin/dashboard.photo_required_without'),
            'image.mimes' => __('admin/dashboard.photo_mimes'),

        ];

    }
}
