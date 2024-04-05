<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'name' => 'sometimes|required|unique:items,name,'.$this->route('item')->id.'|max:255',
            'inventory_id' => 'sometimes|required|exists:inventories,id',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|required|image|image:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'sometimes|required|numeric',
        ];

    }
}
