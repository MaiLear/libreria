<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'name'=> ['required','string'],
            'cost' => ['required','integer'],
            'quantity' => ['required','integer'],
            'author_id' => ['required','integer']
        ];
    }

    public function attributes(){
        return [
            'name'=> 'nombre',
            'cost' => 'valor',
            'quantity' => 'cantidad',
            'author_id' => 'autor'
        ];
    }
}
