<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
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
            'name' => 'required|string|unique:items|max:255',
            'inventory_id' => 'required|exists:inventories,id',
            'description' => 'required|string',
            'image' => 'required|image|image:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|numeric',
        ];
    }
}
