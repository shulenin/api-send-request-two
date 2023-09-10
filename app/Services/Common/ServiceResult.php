<?php

namespace App\Services\Common;

final class ServiceResult
{
    public bool $isError = false;

    public array $errors = [];

    public string $message = '';

    public mixed $data = null;

    public mixed $code = null;

    public static function createErrorResult(string $message, array $errors = [], int $code = null, mixed $data = null): self
    {
        $result = new self();
        $result->isError = true;
        $result->errors = $errors;
        $result->message = $message;
        $result->data = $data;
        $result->code = $code;

        return $result;
    }

    public static function createSuccessResult($data = null): self
    {
        $result = new self();
        $result->isError = false;
        $result->data = $data;

        return $result;
    }
}
