<?php

namespace App\Http\Requests;

use App\Enums\Recipe\ActionUnits;
use App\Enums\Recipe\ProductUnits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecipeRequest extends FormRequest
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
//            'description' => ['nullable', 'string', 'min:5', 'max:1000'],
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'products' => ['required', 'array'],
            'products.*.name' => ['required', 'string', 'min:3', 'max:100'],
            'products.*.quantity' => ['nullable', 'numeric', 'min:1', 'max:1000'],
            'products.*.units' => ['required', Rule::enum(ProductUnits::class)],
            'actions' => ['required', 'array'],
            'actions.*.name' => ['required', 'string', 'min:5', 'max:200'],
            'actions.*.quantity' => ['nullable', 'numeric', 'min:1', 'max:1000'],
            'actions.*.units' => ['required', Rule::enum(ActionUnits::class)],
//            'full_time' => ['nullable', 'string', 'min:3', 'max:10'],
//            'portion' => ['nullable', 'numeric', 'min:1', 'max:50'],
        ];
    }
}
