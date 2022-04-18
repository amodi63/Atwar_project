<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'images' => 'required_without:id|min:1',
            'images.*' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'images.required_without' => __('admin/dashboard.images_required_without'),
            'images.string' => __('admin/dashboard.images_string'),
        ];
    }
}
