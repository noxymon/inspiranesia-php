<?php


namespace App\Controllers\Api;


use App\Controllers\Api\response\HashResponse;

class Hash extends BaseApi
{
    public function generate($id)
    {
        $generateHash = $this->generateHash($id);
        return $this->respond(new HashResponse($generateHash));
    }
}