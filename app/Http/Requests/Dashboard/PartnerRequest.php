<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Enumeration\PartnerType;
use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'link' => 'nullable|max:300',
            'type' => 'required|in:'. PartnerType::ourPartner . ',' . PartnerType::mainPartner,
            'parent_id' => 'sometimes|nullable|numeric',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'description_ar' => 'nullable|max:500',
            'description_en' => 'nullable|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => __('admin/dashboard.name_ar_required'),
            'name_ar.max' => __('admin/dashboard.name_ar_max'),
            'name_en.required' => __('admin/dashboard.name_en_required'),
            'name_en.max' => __('admin/dashboard.name_en_max'),
//            'link.required' => __('admin/dashboard.link_required'),
            'link.max' => __('admin/dashboard.link_max'),
            'type.required' => __('admin/dashboard.type_partner_required'),
            'type.in' => __('admin/dashboard.type_partner_in'),
            'parent_id.sometimes' => __('admin/dashboard.parent_id_sometimes'),
            'photo.required_without' => __('admin/dashboard.photo_required_without'),
            'photo.mimes' => __('admin/dashboard.photo_mimes'),
            'description_ar.required' => __('admin/dashboard.description_ar_required'),
            'description_ar.max' => __('admin/dashboard.description_ar_max'),
            'description_en.required' => __('admin/dashboard.description_en_required'),
            'description_en.max' => __('admin/dashboard.description_en_max'),
        ];
    }
}
