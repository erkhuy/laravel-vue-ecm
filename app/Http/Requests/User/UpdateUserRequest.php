<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'phone' => 'required|numeric|min:10',
            'role_id' => 'required',
            'name' => 'bail|required',
            'address' => 'required',
            'status' => 'required',
            'image' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '* Không được để trống',
            'phone.required' => '* Không được để trống',
            'phone.numeric' => '* Số điện thoại phải là số',
            'phone.min' => '* Số điện thoại phải lớn hơn 9 kí tự',
            'role_id.required' => '* Chọn quyền',
            'address.required' => '* Không được để trống',
            'status.required' => '* chọn trạng thái',
            'image.required' => '* chọn ảnh đại điện',

        ];
    }
}
