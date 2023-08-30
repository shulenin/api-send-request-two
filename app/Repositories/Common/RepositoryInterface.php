<?php

namespace App\Repositories\Common;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getQB(): Builder;
    public function getAll(): Collection;
    public function getOne(int $id): Model|null;
}