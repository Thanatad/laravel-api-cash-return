<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Spatie\Permission\Models\Permission;

class PermissionUnique implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $permission = Permission::where('name', 'like', "{$value}-%")->count();

        $permission > 1 ? $fail('The name has already been taken.') : '';
    }
}
