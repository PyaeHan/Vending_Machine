<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'purchased_quantity' => 'required|integer|min:1',
        ];
    }

    /**
     * Get the validation custom messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'purchased_quantity.min' => 'Please purchase minimum quantity 1.',
        ];
    }
}
