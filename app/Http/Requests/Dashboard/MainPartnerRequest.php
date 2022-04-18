<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MainPartnerRequest extends FormRequest
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
            'link' => 'required|max:300',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'link.required' => __('admin/dashboard.link_required'),
            'link.max' => __('admin/dashboard.link_max'),
            'parent_id.sometimes' => __('admin/dashboard.parent_id_sometimes'),
            'photo.required_without' => __('admin/dashboard.photo_required_without'),
            'photo.mimes' => __('admin/dashboard.photo_mimes'),
        ];
    }
}
