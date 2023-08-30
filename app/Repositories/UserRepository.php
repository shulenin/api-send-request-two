<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Common\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements RepositoryInterface
{
    public function getQB(): Builder
    {
        return User::query();
    }

    public function getAll(): Collection
    {
        return $this->getQB()->get();
    }

    public function getOne(int $id): Model
    {
        return $this->getQB()
            ->where('id', '=', $id)
            ->first();
    }

    public function getByEmail(string $email): Model|null
    {
        return $this->getQB()
            ->where('email', '=', $email)
            ->first();
    }
}