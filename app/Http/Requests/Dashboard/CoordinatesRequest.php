<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CoordinatesRequest extends FormRequest
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
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'address_ar.required' => __('admin/dashboard.title_ar_required'),
            'address_ar.max' => __('admin/dashboard.title_ar_max'),
            'address_en.required' => __('admin/dashboard.title_en_required'),
            'address_en.max' => __('admin/dashboard.title_en_max'),
            'longitude.required' => __('admin/dashboard.longitude_required'),
            'longitude.numeric' => __('admin/dashboard.longitude_numeric'),
            'latitude.required' => __('admin/dashboard.latitude_required'),
            'latitude.numeric' => __('admin/dashboard.latitude_numeric'),

        ];
    }
}
