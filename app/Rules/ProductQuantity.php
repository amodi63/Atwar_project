<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductQuantity implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private  $in_stock;
    public function __construct($in_stock)
    {
        $this->in_stock =  $in_stock;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->in_stock == 1 && $value == null)
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('admin/dashboard.quantity_required');
    }
}
