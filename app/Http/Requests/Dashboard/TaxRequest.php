<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
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
            'name_ar' => 'required|max:200',
            'name_en' => 'required|max:200',
            'amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => __('admin/dashboard.name_ar_required'),
            'name_ar.max' => __('admin/dashboard.name_ar_max'),
            'name_en.required' => __('admin/dashboard.name_en_required'),
            'name_en.max' => __('admin/dashboard.name_en_max'),
            'amount.required' => __('admin/dashboard.amount_required'),
            'amount.numeric' => __('admin/dashboard.amount_numeric'),

        ];
    }
}
