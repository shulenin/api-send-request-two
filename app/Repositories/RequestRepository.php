<?php

namespace App\Repositories;

use App\Models\Request;
use App\Repositories\Common\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RequestRepository implements RepositoryInterface
{
    public function getQB(): Builder
    {
        return Request::query();
    }

    public function getAll(): Collection
    {
        return $this->getQB()->get();
    }

    public function getOne(int $id): Model|null
    {
        return $this->getQB()
            ->where('id', '=', $id)
            ->first();
    }

    public function getAllByPendingStatus()
    {
        return $this->getQB()
            ->with('user')
            ->where('requests.status', '=', Request::PENDING_STATUS)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getAllByAnsweredStatus()
    {
        return $this->getQB()
            ->with('user')
            ->where('requests.status', '=', Request::ANSWERED_STATUS)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getCountByPendingStatus(): int
    {
        return $this->getQB()
            ->where('status', '=', Request::PENDING_STATUS)
            ->count();
    }

    public function getCountByAnsweredStatus(): int
    {
        return $this->getQB()
            ->where('status', '=', Request::ANSWERED_STATUS)
            ->count();
    }
}
