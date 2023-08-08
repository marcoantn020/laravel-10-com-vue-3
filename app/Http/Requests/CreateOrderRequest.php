<?php

namespace App\Http\Requests;

use App\Rules\UniqueArray;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_client' => 'required|string',
            'bread' => 'required|string',
            'meat' => 'required|string',
            'burger_id' => 'required|numeric',
            'options' => ['array', new UniqueArray()]
        ];
    }
}
