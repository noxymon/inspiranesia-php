<?php


namespace App\Models\Member\Output;


class MemberOutput
{
    public string $id; //String
    public bool $active; //String
    public $createDate; //Date
    public $dateOfBirth; //Date
    public string $email; //String
    public $firstName; //String
    public $lastName; //String
    public $memberType; //String
    public $password; //String
    public $updateDate; //array( undefined )
    public $userCreated; //String
    public $userUpdated; //array( undefined )

    public function __construct(string $id, $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}