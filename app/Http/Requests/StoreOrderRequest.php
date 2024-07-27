<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'product_id' => 'required',
            'name' => 'nullable|min:5|max:30',
            'email' => 'nullable|email|unique:App\Models\Customer,email',
            'phone' => 'nullable|digits:10',
            'customer_id' => 'required_without:name'
        ];
    }

    public function messages(){
        return [
            'product_id.required' => "Vui lòng chọn sản phẩm muốn đặt",
            'customer_id.required_without' => 'Vui lòng chọn khách hàng đã đăng ký hoặc đăng ký khách hàng mới',
        ];
    }
}
