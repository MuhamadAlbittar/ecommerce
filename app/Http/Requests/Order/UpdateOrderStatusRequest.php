<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        // يمكنك إضافة صلاحيات هنا، مثلاً التأكد من أن المستخدم هو Admin
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:pending,completed'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'حقل الحالة مطلوب',
            'status.in'       => 'الحالة غير صالحة، يجب أن تكون pending أو completed',
        ];
    }
}
