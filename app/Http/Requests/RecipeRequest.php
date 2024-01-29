<?php

namespace App\Http\Requests;

use App\Enums\Recipe\ActionUnits;
use App\Enums\Recipe\CategoryRecipes;
use App\Enums\Recipe\ProductUnits;
use App\Enums\Recipe\TypeRecipes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'description' => ['nullable', 'string', 'min:10', 'max:1000'],
            'products' => ['required', 'array'],
            'products.*.name' => ['required', 'string', 'min:3', 'max:100'],
            'products.*.quantity' => ['nullable', 'numeric', 'min:1', 'max:1000'],
            'products.*.units' => ['required', Rule::enum(ProductUnits::class)],
            'actions' => ['required', 'array'],
            'actions.*.name' => ['required', 'string', 'min:5', 'max:200'],
            'actions.*.quantity' => ['nullable', 'numeric', 'min:1', 'max:1000'],
            'actions.*.units' => ['required', Rule::enum(ActionUnits::class)],
            'type' => ['nullable', new Enum(TypeRecipes::class)],
            'category' => ['nullable', new Enum(CategoryRecipes::class)],
            'full_time' => ['nullable', 'string', 'min:4', 'max:15'],
            'portion' => ['nullable', 'numeric', 'min:1', 'max:50'],
        ];
    }
}
