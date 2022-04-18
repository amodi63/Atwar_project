<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\ProductQuantity;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'price' => 'required|min:0|numeric',
            'offer' => 'nullable|max:200',
            'category_id' => 'required|numeric|exists:categories,id',
            'company_id' => 'required|numeric|exists:companies,id',
            'model_id' => 'required|numeric|exists:models,id',
            'sku' => 'required|max:200',
            'in_stock' => 'required|in:0,1',
            'quantity' =>  [new ProductQuantity($this->manage_stock)],
            'description_ar' => 'required|max:10000',
            'description_en' => 'required|max:10000',
            'images' => 'required_without:id|min:1',
            'images.*' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => __('admin/dashboard.name_ar_required'),
            'name_ar.max' => __('admin/dashboard.name_ar_max'),
            'name_en.required' => __('admin/dashboard.name_en_required'),
            'name_en.max' => __('admin/dashboard.name_en_max'),
            'price.required' => __('admin/dashboard.price_required'),
            'price.min' => __('admin/dashboard.price_min'),
            'price.numeric' => __('admin/dashboard.price_numeric'),
            'offer.max' => __('admin/dashboard.offer_max'),
            'category_id.required' => __('admin/dashboard.category_id_required'),
            'category_id.numeric' => __('admin/dashboard.category_id_numeric'),
            'category_id.exists' => __('admin/dashboard.category_id_exists'),
            'company_id.required' => __('admin/dashboard.company_id_required'),
            'company_id.numeric' => __('admin/dashboard.company_id_numeric'),
            'company_id.exists' => __('admin/dashboard.company_id_exists'),
            'model_id.required' => __('admin/dashboard.model_id_required'),
            'model_id.numeric' => __('admin/dashboard.model_id_numeric'),
            'model_id.exists' => __('admin/dashboard.model_id_exists'),
            'sku.required' => __('admin/dashboard.sku_required'),
            'sku.max' => __('admin/dashboard.sku_max'),
            'in_stock.required' => __('admin/dashboard.in_stock_required'),
            'in_stock.in' => __('admin/dashboard.in_stock_in'),
            'description_ar.required' => __('admin/dashboard.description_ar_required'),
            'description_ar.max' => __('admin/dashboard.description_ar_max'),
            'description_en.required' => __('admin/dashboard.description_en_required'),
            'description_en.max' => __('admin/dashboard.description_en_max'),
            'images.required_without' => __('admin/dashboard.images_required_without'),
            'images.string' => __('admin/dashboard.images_string'),
        ];
    }
}
