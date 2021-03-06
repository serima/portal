<?php

namespace App\Validation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

final class DoesNotContainUrlRule implements Rule
{
    use ValidatesAttributes;

    const NAME = 'not_contain_url';

    public function passes($attribute, $value): bool
    {
        return ! collect(explode(' ', $value))->contains(function ($word) {
            return $this->validateRequired('word', $word) && $this->validateUrl('word', $word);
        });
    }

    public function message(): string
    {
        return 'The :attribute field cannot contain an url.';
    }
}
