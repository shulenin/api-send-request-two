<?php

namespace App\Core\Traits;

trait HasLabels
{
    public static function getAttributeLabel(string $attributeName): string
    {
        return self::getAttributesLabels()[$attributeName] ?? $attributeName;
    }
}
