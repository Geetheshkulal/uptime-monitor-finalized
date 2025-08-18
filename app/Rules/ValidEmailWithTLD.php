<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidEmailWithTLD implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if it's a valid email
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $fail('The :attribute must be a valid email address.');
            return;
        }

        // Ensure domain contains a dot (TLD present)
        $domain = substr(strrchr($value, "@"), 1);
        if (strpos($domain, '.') === false) {
            $fail('The :attribute must include a valid top-level domain (e.g., .com, .org).');
        }
    }
}
