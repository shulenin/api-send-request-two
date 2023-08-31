<?php

namespace App\Services;

use App\Models\Request;
use App\Services\Common\ServiceResult;
use Illuminate\Support\Facades\Validator;

class RequestService
{
    public function send(array $data): ServiceResult
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string', 'max:500'],
        ];
        $messages = [
            'required' => 'Field is required',
            'string' => 'Must be string',
            'max' => 'Max count - :max',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return ServiceResult::createErrorResult(
                'Data is incorrect.',
                $validator->errors()->toArray(),
            );
        }

        $data['user_id'] = auth()->id();
        $data['status'] = Request::PENDING_STATUS;

        $request = new Request();

        $request->fill($data);

        if (! $request->save()) {
            return ServiceResult::createErrorResult('Request not be saved.');
        }

        return ServiceResult::createSuccessResult(['message' => 'success']);
    }
}
