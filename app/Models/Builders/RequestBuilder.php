<?php

namespace App\Models\Builders;

use App\Enums\RequestType;
use Illuminate\Database\Eloquent\Builder;

class RequestBuilder extends Builder
{
    public function pending(): RequestBuilder
    {
        return $this->where('status', '=', RequestType::Pending);
    }

    public function answered(): RequestBuilder
    {
        return $this->where('status', '=', RequestType::Answered);
    }

    public function byId(int $id): RequestBuilder
    {
        return $this->where('id', '=', $id);
    }
}