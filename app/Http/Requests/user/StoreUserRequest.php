<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed',Password::defaults()],
            'role' => ['nullable', 'in:customer,vendor_user,admin'],
            'phone' => ['nullable', 'regex:/^[0-9+\-\s]{7,20}$/'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'street' => ['nullable', 'string', 'max:150'],
            'building' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'الاسم قصير جداً',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'صيغة البريد غير صحيحة',
            'email.unique' => 'البريد مستخدم مسبقاً',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق',
            'phone.regex' => 'رقم الهاتف غير صالح',
            'role.in' => 'نوع المستخدم غير مسموح',
        ];
    }
}
