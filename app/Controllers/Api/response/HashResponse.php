<?php


namespace App\Controllers\Api\response;


class HashResponse
{
    public string $hash;

    /**
     * HashResponse constructor.
     * @param string $hash
     */
    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }


}