<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'products' => 'required|array|min:1',
            'products.*' => 'numeric|exists:products,id',
            'code' => 'required|max:100',
            'type' => 'required|numeric|in:1,2',
            'percent_discount' => 'required|numeric',
            'start_datetime' => 'required|date_format:Y-m-d\TH:i|before_or_equal:end_datetime',
            'end_datetime' => 'required|date_format:Y-m-d\TH:i|after_or_equal:start_datetime',
        ];
    }

    public function messages()
    {
        return[

            'products.required' => __('admin/dashboard.products_required'),
            'products.exist' => __('admin/dashboard.products_exist'),
            'products.numeric' => __('admin/dashboard.products_numeric'),
            'code.required' => __('admin/dashboard.code_required'),
            'code.max' => __('admin/dashboard.code_max'),
            'type.required' => __('admin/dashboard.type_required'),
            'type.numeric' => __('admin/dashboard.type_numeric'),
            'type.in' => __('admin/dashboard.type_in'),
            'percent_discount.required' => __('admin/dashboard.percent_discount_required'),
            'percent_discount.numeric' => __('admin/dashboard.percent_discount_numeric'),
            'start_datetime.required' => __('admin/dashboard.start_datetime_required'),
            //'start_datetime.date_format' => __('admin/dashboard.start_datetime_date_format'),
            'start_datetime.before_or_equal' => __('admin/dashboard.start_datetime_before_or_equal'),
            'end_datetime.required' => __('admin/dashboard.end_datetime_required'),
            //'end_datetime.date_format' => __('admin/dashboard.end_datetime_date_format'),
            'end_datetime.before_or_equal' => __('admin/dashboard.end_datetime_before_or_equal'),

        ];

    }
}
