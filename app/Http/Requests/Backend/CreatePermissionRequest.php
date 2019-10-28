<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
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
            'display_name' => 'bail|required',
            'name' => 'bail|required|unique:permissions,name',
        ];
    }
    public function messages()
    {
        return [
            'display_name.required' => ' * Tên hiển thị  không được để trống',
            'name.required' => ' * Tên  không được để trống',
            'name.unique' => '* Tên đã được sử dụng chọn tên khác',
        ];
    }
}