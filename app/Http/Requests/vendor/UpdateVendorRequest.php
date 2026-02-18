<?php

namespace App\Http\Requests\vendor;

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
                'name' => 'required|string|max:255|unique:vendors,name',
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

        'description.string' => 'الوصف يجب أن يكون نص',

        'status.required' => 'حالة البائع مطلوبة',
        'status.boolean' => 'قيمة الحالة غير صحيحة',

        'logo.image' => 'الملف يجب أن يكون صورة',
        'logo.max' => 'حجم الصورة يجب ألا يتجاوز 2MB',
    ];
}
