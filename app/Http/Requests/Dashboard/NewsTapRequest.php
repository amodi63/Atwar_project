<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class NewsTapRequest extends FormRequest
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
            'description_ar' => 'required|max:500',
            'description_en' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'description_ar.required' => __('admin/dashboard.description_ar_required'),
            'description_ar.max' => __('admin/dashboard.description_ar_max'),
            'description_en.required' => __('admin/dashboard.description_en_required'),
            'description_en.max' => __('admin/dashboard.description_en_max'),
        ];
    }
}
