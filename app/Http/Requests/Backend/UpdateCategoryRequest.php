<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'bail|required|unique:categories,name,' . $this->category,
            'parent_id' => 'required',
        ];
    }
    public function messages()
    {
        return [

            'name.required' => ' * Tên  không được để trống',
            'name.unique' => '* Tên đã được sử dụng chọn tên khác',
            'parent_id.required' => ' * Chọn  category cha',
        ];
    }
}