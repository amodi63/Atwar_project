<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'. $this -> id,
            'password' => 'nullable|confirmed|min:8',
            'image' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => __('admin/dashboard.name.required'),
            'email.required' => __('admin/dashboard.email.required'),
            'email.email' => __('admin/dashboard.email.email'),
            'email.unique' => __('admin/dashboard.email.unique'),
            'password.confirmed' => __('admin/dashboard.password.confirmed'),
            'password.min' => __('admin/dashboard.password.min'),
            'image.required_without' => __('admin/dashboard.image.required_without'),
            'image.mimes' => __('admin/dashboard.image.mimes'),
        ];

    }
}
