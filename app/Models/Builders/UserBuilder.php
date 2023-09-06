<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function byEmail(string $email): UserBuilder
    {
        return $this->where('email', '=', $email);
    }
}