<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Null_if implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private bool $when)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !$this->when ?: $value === null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return !$this->when ?: __(":attribute") . " باید خالی باشد";
    }
}
