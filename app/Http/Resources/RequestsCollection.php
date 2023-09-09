<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RequestsCollection extends ResourceCollection
{
    public $collects = RequestResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
