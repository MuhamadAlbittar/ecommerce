<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'name' => 'required|string|max:255,name',
                'email' => 'required|string|email|max:255,email',
                'phone' => 'required|string|max:20,phone',
                'description' => 'nullable|string|max:1000',
                'status' => 'required|boolean',
                'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ];
    }
    public function messages(): array
{
    return [
        'name.required' => 'اسم البائع مطلوب',
        'name.max' => 'اسم البائع يجب ألا يتجاوز 255 حرف',
        'name.unique' => 'اسم البائع مستخدم بالفعل',
        'email.required' => 'البريد الإلكتروني مطلوب',
        'email.email' => 'البريد الإلكتروني غير صالح',
        'email.max' => 'البريد الإلكتروني يجب ألا يتجاوز 255 حرف',
        'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
        'phone.required' => 'رقم الهاتف مطلوب',
        'phone.max' => 'رقم الهاتف يجب ألا يتجاوز 20 حرف',

        'description.string' => 'الوصف يجب أن يكون نص',

        'status.required' => 'حالة البائع مطلوبة',
        'status.boolean' => 'قيمة الحالة غير صحيحة',

        'logo.image' => 'الملف يجب أن يكون صورة',
        'logo.max' => 'حجم الصورة يجب ألا يتجاوز 2MB',
    ];
}
}
