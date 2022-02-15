<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * ['value', 'currency_code', 'territory']
     */
    public function rules(): array
    {
        return [
            'currency_code' => 'required|unique:prices|min:3|max:3|string',
            'territory' => 'required|min:3|max:40|string',
        ];
    }
}
