<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Platform\Models\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 *
 * @property Request $requests
 */
class User extends Authenticatable
{
    use HasApiTokens;

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

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
