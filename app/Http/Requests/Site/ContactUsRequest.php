<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'subject' => 'required|max:200',
            'name' => 'required|max:200',
            'email1' => 'required|max:100|email',
            'description' => 'required|max:3000',
        ];
    }

    public function messages()
    {
        return[
            'customer_id.required' => __('site/site.customer_id_required'),
            'customer_id.exist' => __('site/site.customer_id_exist'),
            'customer_id.numeric' => __('site/site.customer_id_numeric'),
            'subject.required' => __('site/site.subject_required'),
            'subject.max' => __('site/site.subject_max'),
            'name.required' => __('site/site.name_required'),
            'name.max' => __('site/site.name_max'),
            'email1.required' => __('site/site.email_required'),
            'email1.email' => __('site/site.email_email'),
            'email1.max' => __('site/site.email_max'),
            'description.required' => __('site/site.description_required'),
            'description.max' => __('site/site.description_max'),

        ];

    }
}
