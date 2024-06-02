<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
                'min:6',
                // Tuỳ chọn: 'regex:/^[\pL\s\-]+$/u' để chỉ cho phép chữ cái, khoảng trắng và dấu gạch ngang
            ],
            'slug' => [
                'required',
                'string',
                'max:100',
                'min:6',
                'alpha_dash', // Đảm bảo slug chỉ chứa chữ cái, số, dấu gạch ngang và gạch dưới
                'unique:your_table_name,slug', // Đảm bảo slug là duy nhất trong bảng cơ sở dữ liệu của bạn
            ],
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048' // Kích thước tệp tối đa tính bằng kilobyte
            ],
            'price' => [
                'required',
                'numeric',
                'min:0', // Đảm bảo giá không âm
            ],
            'discount' => [
                'required',
                'numeric',
                'min:0', // Đảm bảo chiết khấu không âm
                'max:100', // Giả sử chiết khấu là phần trăm
            ],
            'quantity' => [
                'required',
                'integer',
                'min:0', // Đảm bảo số lượng không âm
            ],
            'description' => [
                'required',
                'string',
                'min:10', // Tùy chọn đặt độ dài tối thiểu cho mô tả
            ],
            'category_id' => [
                'required',
                'exists:categories,id' // Đảm bảo category ID tồn tại trong bảng categories
            ],
            'status' => [
                'required',
                'in:active,inactive', // Giả sử trạng thái là 'active' hoặc 'inactive'
            ],
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'Vui lý nhap :attribute',
    //         'name.string' => 'Ten phai la chuoi',
    //         'name.max' => 'Ten phai nho hon 100 ky tu',
    //         'name.min' => 'Ten phai lon hon 6 ky tu',
    //     ];
    // }

    // public function attributes()
    // {
    //     return [
    //         'name' => 'Tên',
    //         'slug' => 'Định danh',
    //         'image' => 'Hình',
    //         'price' => 'Giá',
    //         'discount' => 'Giảm giá',
    //         'quantity' => 'Số lượng',
    //         'description' => 'Mô tả',
    //         'category_id' => 'Danh mục',
    //         'status' => 'Trạng thái',
    //     ];
    // }
}
