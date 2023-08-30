<?php

namespace App\Models;

use Orchid\Platform\Models\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 */
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];
}
