<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:customers,email,'. $this -> id,
            'password' => 'required|min:4|max:100',
            'terms_conditions' => 'accepted',
        ];
    }

    public function messages()
    {
        return[
            'first_name.required' => __('site/site.first_name_required'),
            'first_name.max' => __('site/site.first_name_max'),
            'last_name.required' => __('site/site.last_name_required'),
            'last_name.max' => __('site/site.last_name_max'),
            'email.required' => __('site/site.email_required'),
            'email.email' => __('site/site.email_email'),
            'email.max' => __('site/site.email_max'),
            'email.unique' => __('site/site.email_unique'),
            'password.required' => __('site/site.password_required'),
            'password.min' => __('site/site.password_min'),
            'password.max' => __('site/site.password_max'),
            'terms_conditions.accepted' => __('site/site.terms_conditions_accepted'),

        ];

    }
}
