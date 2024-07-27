<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $product = $this->route('product');
        return [
            'name' => 'required|unique:products,name,' . $product->id,
            'image' => 'nullable|image|max:2048',
            'price' => 'required',
            'stock_qty' => 'required',
            'supplier_id' => 'required',
            'description' => 'nullable',
        ];
    }
}
