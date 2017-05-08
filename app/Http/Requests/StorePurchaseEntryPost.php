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
        $rules = [
            'date' => 'required|date_format:m/d/Y|before:tomorrow',
            'purchased_by' => 'required|alpha',
            'vendor_id' => 'required|numeric',
            'amountPaid' => 'numeric',
            'document' => 'required|mimes:png,jpeg,jpg'
        ];

        return $rules;
    }
}
