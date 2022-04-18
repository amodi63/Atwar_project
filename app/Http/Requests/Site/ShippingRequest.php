<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'customer_id' => 'required|numeric|exists:customers,id',
            'first_name1' => 'required|max:200',
            'last_name1' => 'required|max:200',
            'address' => 'required|max:500',
            'city' => 'required|max:100',
            'postal_code' => 'required|max:100',
            'phone' => 'required|max:20',
            'country' => 'required|max:100',
            'email1' => 'required|max:100|email',
        ];
    }

    public function messages()
    {
        return[
            'customer_id.required' => __('site/site.customer_id_required'),
            'customer_id.exist' => __('site/site.customer_id_exist'),
            'customer_id.numeric' => __('site/site.customer_id_numeric'),
            'first_name1.required' => __('site/site.first_name_required'),
            'first_name1.max' => __('site/site.first_name_max'),
            'last_name1.required' => __('site/site.last_name_required'),
            'last_name1.max' => __('site/site.last_name_max'),
            'address.required' => __('site/site.address_required'),
            'address.max' => __('site/site.address_max'),
            'city.required' => __('site/site.city_required'),
            'city.max' => __('site/site.city_max'),
            'postal_code.required' => __('site/site.postal_code_required'),
            'postal_code.max' => __('site/site.postal_code_max'),
            'phone.required' => __('site/site.phone_required'),
            'phone.max' => __('site/site.phone_max'),
            'country.required' => __('site/site.country_required'),
            'country.max' => __('site/site.country_max'),
            'email1.required' => __('site/site.email_required'),
            'email1.email' => __('site/site.email_email'),
            'email1.max' => __('site/site.email_max'),

        ];

    }
}
