<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
    {
        return true; // لاحقاً تربطه بالـ Policy
    }

    public function rules(): array
    {
        $id = $this->route('category')?->id;

        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'parent_id' => 'nullable|not_in:'.$id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'اسم التصنيف مطلوب.',
            'name.string' => 'اسم التصنيف يجب أن يكون نصاً.',
            'name.max' => 'اسم التصنيف لا يجب أن يتجاوز 255 حرفاً.',
            'name.unique' => 'اسم التصنيف مستخدم بالفعل.',
            'parent_id.exists' => 'التصنيف الأب غير موجود.',
            'description.string' => 'الوصف يجب أن يكون نصاً.',
            'status.required' => 'حالة التصنيف مطلوبة.',
            'status.boolean' => 'حالة التصنيف يجب أن تكون صحيحة أو خاطئة.',
            'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            'image.mimes' => 'الملف المرفق يجب أن يكون من نوع jpg, jpeg, أو png.',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت.',
        ];
    }
}
