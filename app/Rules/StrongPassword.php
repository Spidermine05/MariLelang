<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/[A-Z]/', $value)) {
            $fail('Password harus mengandung minimal 1 huruf kapital.');
        }
        if (!preg_match('/[0-9]/', $value)) {
            $fail('Password harus mengandung minimal 1 angka.');
        }
    }
}
