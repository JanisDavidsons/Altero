<?php

namespace myApp\Core\Validator;

use myApp\Interfaces\ValidateInterface;

class Validate implements ValidateInterface
{
    public static function validateAmount($amount): bool
    {
        $isNumber = preg_match('/[0-9]/', $amount);
        if (!$isNumber) {
            return false;
        }
        return true;
    }
}