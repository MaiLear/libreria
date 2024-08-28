<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'quantity' => ['required','integer'],
            'user_id' => ['required','integer'],
            'book_id' => ['required','integer'],
        ];
    }

    public function attributes(){
        return [
            'quantity' => 'cantidad',
            'user_id' => 'usuario',
            'book_id' => 'libro',
        ];
    }
}
