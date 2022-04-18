<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'title_ar' => 'required|max:200',
            'title_en' => 'required|max:200',
            'description_ar' => 'required|max:10000',
            'description_en' => 'required|max:10000',
        ];
    }

    public function messages()
    {
        return [
            'title_ar.required' => __('admin/dashboard.title_ar_required'),
            'title_ar.max' => __('admin/dashboard.title_ar_max'),
            'title_en.required' => __('admin/dashboard.title_en_required'),
            'title_en.max' => __('admin/dashboard.title_en_max'),
            'description_ar.required' => __('admin/dashboard.description_ar_required'),
            'description_ar.max' => __('admin/dashboard.description_ar_max'),
            'description_en.required' => __('admin/dashboard.description_en_required'),
            'description_en.max' => __('admin/dashboard.description_en_max'),
        ];
    }
}
