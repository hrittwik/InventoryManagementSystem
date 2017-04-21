<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitPost extends FormRequest implements SanitizePostRequestInterface
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
        $this->sanitize();

        $id = (!is_null($this['id']) ? $this['id'] : '');

        return [
            'name' => 'required|max:255',
            'short_name' => 'required|max:10|unique:units,short_name,'.$id
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        foreach ($input as $key => $value) {
            $input[(string) $key] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        $this->replace($input);
    }
}
