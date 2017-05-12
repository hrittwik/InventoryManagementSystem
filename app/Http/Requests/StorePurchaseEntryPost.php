<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseEntryPost extends FormRequest
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
        return $rules = [
            'date' => 'required|date_format:m/d/Y|before:tomorrow',
            'purchased_by' => 'required|alpha',
            'vendor_id' => 'required|numeric',
            'amountPaid' => 'numeric',
            'document' => 'required|mimes:png,jpeg,jpg',
            'purchase_details.product_id' => 'required|numeric',
            'purchase_details.unit' => 'required',
            'purchase_details.quantity' => 'required|numeric',
            'purchase_details.rate' => 'required|numeric',
        ];
    }

}
