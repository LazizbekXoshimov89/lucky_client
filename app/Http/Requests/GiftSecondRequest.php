<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftSecondRequest extends FormRequest
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

                'id' => 'required|integer|exists:gifts,id',

        ];
    }

    public function messages()
{
    return [
        'id.required' => 'gift id kiritilmadi!',
        'id.integer' => 'gift id raqam bolishi kerak',
        'id.exists' => 'bunday id li gift mavjud emas!',
    ];
}
}
