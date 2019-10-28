<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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

            'name' => 'bail|required|unique:products,name',
            'description' => 'bail|required',
            'images' => 'required',
            'status' => 'required',
            'image' => 'required',
            'sizes' => 'bail|required',
            'price' => 'required|numeric|min:0',
            'colors' => 'required',
            'categories' => 'required',
            'amount' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '* Không được để trống',
            'name.unique' => '* Tên  đã được sử dụng',
            'description.required' => '* Không được để trống',
            'images.required' => '* Chọn ảnh cho sản phẩm',
            'price.required' => '* Không được để trống',
            'price.numeric' => '* Giá phải là số',
            'price.min' => '* Giá phải lớn hơn 0',
            'status.required' => '* chọn trạng thái',
            'image.required' => '* chọn ảnh đại điện',
            'sizes.required' => '* Chọn kích cỡ',
            'colors.required' => '* Chọn màu',
            'categories.required' => '* Chọn danh mục',
            'amount.required' => '* Nhập số lượng',
            'amount.numeric' => '* Giá phải là số',
            'amount.min' => '* Giá phải lớn hơn 0',

        ];
    }
}
