<?php


namespace App\Controllers\Api;


use App\Controllers\Api\response\InvalidHashException;

class BaseApi extends \CodeIgniter\RESTful\ResourceController
{
    protected $format = 'json';

    protected function validateHash(string $hash, string $memberId): bool{
        $hashAcuan = $this->generateHash($memberId);
        if(strcmp($hash, $hashAcuan) <> 0){
            throw new InvalidHashException("Invalid Request");
        }
        return true;
    }

    protected function generateHash(string $memberId): string{
        $currentTimeString = (new \DateTime('now'))->format('YmdHi');
        $originalString = $memberId.'exampleHash'.$currentTimeString;
        return md5($originalString);
    }
}