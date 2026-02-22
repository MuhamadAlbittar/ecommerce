<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorRequest extends FormRequest
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
                'name' => 'required|string|max:255|unique:vendors,name',
                'email' => 'required|string|email|max:255|unique:vendors,email',
                'phone' => 'required|string|max:20,phone',
                'description' => 'nullable|string|max:1000',
                'status' => 'required|boolean',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
             ];
    }
        // public function attributes(): array
        // {
        //     return [
        //         'name' => 'اسم البائع',
        //         'description' => 'الوصف',
        //         'status' => 'الحالة',
        //         'logo' => 'الشعار',
        //     ];
        // }

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

        'image.image' => 'الملف يجب أن يكون صورة',
        'image.max' => 'حجم الصورة يجب ألا يتجاوز 2MB',
    ];
}
}
