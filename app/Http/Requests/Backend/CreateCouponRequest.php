<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
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

            'discount' => 'required|numeric',
            'type' => 'required',
            'code' => 'bail|required|unique:coupons,code',
            'amount' => 'bail|required|numeric',
            'expiry_date' => 'required',
            'status' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'discount.required' => '* Không được để trống',
            'discount.numeric' => '* Giá trị  phải là số',
            'type.required' => '* Chọn loại mã giảm giá',
            'code.required' => '* Không được để trống',
            'code.unique' => '* Mã c ode đã được sử dụng ! Chọn mã khác',
            'amount.required' => '* Không được để trống',
            'amount.numeric' => '* Số lượng phải là số',
            'expiry_date.required' => '* Không được để trống',
            'status.required' => '* Chọn trạng thái',

        ];
    }
}