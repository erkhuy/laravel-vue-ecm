<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'password' => 'bail|required|min:6',
            'phone' => 'required|numeric|min:10',
            'role_id' => 'required',
            'email' => 'bail|required|email|unique:users,email',
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
            'password.required' => '* Không được để trống',
            'password.min' => '* Mật khẩu phại lớn hơn 6 kí tự',
            'phone.required' => '* Không được để trống',
            'phone.numeric' => '* Số điện thoại phải là số',
            'phone.min' => '* Số điện thoại phải lớn hơn 9 kí tự',
            'role_id.required' => '* Chọn quyền',

            'email.required' => '* Không được để trống',
            'email.email' => '* Nhập đúng định dạng name@domain.com',
            'email.unique' => '* Email đã được sử dụng',
            'address.required' => '* Không được để trống',
            'status.required' => '* chọn trạng thái',
            'image.required' => '* chọn ảnh đại điện',

        ];
    }
}