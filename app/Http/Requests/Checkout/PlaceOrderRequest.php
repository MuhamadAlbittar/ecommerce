<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method_id.required' => 'الرجاء اختيار طريقة الدفع',
            'payment_method_id.exists'   => 'طريقة الدفع غير صالحة',
        ];
    }
}
