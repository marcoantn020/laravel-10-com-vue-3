<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueArray implements Rule
{
    public function passes($attribute, $value): bool
    {
        return count($value) === count(array_unique($value));
    }

    public function message(): string
    {
        return 'Os valores no campo :attribute não podem ser repetidos.';
    }
}
