<?php


namespace App\Repositories;


use CodeIgniter\Model;

class MemberRepository extends Model
{
    protected $useTimestamps = true;
    protected $table         = 'master_member';
    protected $returnType    = 'App\Repositories\Entities\MemberEntity';
}