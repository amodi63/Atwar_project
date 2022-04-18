<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ContactInformationRequest extends FormRequest
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
            'address_ar' => 'required|max:200',
            'address_en' => 'required|max:200',
            'phone' => 'required|max:13',
            'email' => 'required|email|max:200',
            'description_ar' => 'required|max:500',
            'description_en' => 'required|max:500',

        ];
    }

    public function messages()
    {
        return[
            'address_ar.required' => __('admin/dashboard.title_ar_required'),
            'address_ar.max' => __('admin/dashboard.title_ar_max'),
            'address_en.required' => __('admin/dashboard.title_en_required'),
            'address_en.max' => __('admin/dashboard.title_en_max'),
            'email.required' => __('admin/dashboard.email.required'),
            'email.email' => __('admin/dashboard.email.email'),
            'email.max' => __('admin/dashboard.email.max'),
            'phone.required' => __('admin/dashboard.phone.required'),
            'phone.max' => __('admin/dashboard.phone.max'),
            'description_ar.required' => __('admin/dashboard.description_ar_required'),
            'description_ar.max' => __('admin/dashboard.description_ar_max'),
            'description_en.required' => __('admin/dashboard.description_en_required'),
            'description_en.max' => __('admin/dashboard.description_en_max'),

        ];

    }
}
