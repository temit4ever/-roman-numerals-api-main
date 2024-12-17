<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ConvertIntegerToRomanRequest extends FormRequest
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
            'integer_value' => [
                'required',
                'integer',

                // Use anonymous function for integer and range validation
                function ($attribute, $value, $fail) {

                    // Integer validation
                    if (!is_integer($value)) {
                        $fail("The $attribute must be a valid integer.");
                    }

                    // Integer range validation
                    if ($value < 1 || $value > 3999) {
                        $fail("The $attribute must be between 1 and 3999.");
                    }
                },
            ]
        ];
    }
}
