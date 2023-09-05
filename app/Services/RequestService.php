<?php

namespace App\Services;

use App\Enums\RequestType;
use App\Models\Request;
use App\Services\Common\ServiceResult;

class RequestService
{
    public function send(array $data): ServiceResult
    {
        $data['user_id'] = auth()->id();
        $data['status'] = RequestType::Pending;

        $request = new Request();

        $request->fill($data);

        if (! $request->save()) {
            return ServiceResult::createErrorResult('Request not be saved.');
        }

        return ServiceResult::createSuccessResult(['message' => 'success']);
    }
}
