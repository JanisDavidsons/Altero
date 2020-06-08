<?php


namespace myApp\Interfaces;


interface ValidateInterface
{
    public static function validateAmount($amount):bool;
}