<?php


namespace App\Controllers\Api\response;


use Throwable;

class InvalidHashException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message, 0, null);
    }
}