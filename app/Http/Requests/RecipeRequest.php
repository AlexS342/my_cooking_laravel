<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'numeric'],
            'description' => ['nullable', 'numeric', 'min:1', 'max:1000'],
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'full_time' => ['nullable', 'string', 'min:3', 'max:10'],
            'portion' => ['nullable', 'numeric', 'min:1', 'max:50'],
        ];
    }
}
