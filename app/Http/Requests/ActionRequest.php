<?php

namespace App\Http\Requests;

use App\Enums\Recipe\ActionUnits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ActionRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5', 'max:200'],
            'quantity' => ['nullable', 'numeric', 'min:1', 'max:1000'],
            'units' => ['required', 'required', new Enum(ActionUnits::class)]
        ];
    }
}
