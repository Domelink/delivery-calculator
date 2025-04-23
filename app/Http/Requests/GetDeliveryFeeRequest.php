<?php

namespace App\Http\Requests;

use App\Enums\DeliveryType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

final class GetDeliveryFeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'delivery_type' => [
                'bail',
                'required',
                'string',
                Rule::enum(DeliveryType::class),
            ],
            'destination' => [
                'bail',
                'required',
                'string',
                'max:255',
            ],
            'weight' => [
                'bail',
                'required',
                'numeric',
                'min:0.1',
                'max:100',
                'regex:/^\d+(\.\d{1})?$/',
            ],
        ];
    }
}
