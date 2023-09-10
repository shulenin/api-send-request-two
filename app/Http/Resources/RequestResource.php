<?php

namespace App\Http\Resources;

use App\Enums\RequestType;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'status' => RequestType::from($this->status)->name,
        ];
    }
}
