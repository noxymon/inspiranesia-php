<?php


namespace App\Repositories;


use CodeIgniter\Model;

class CourseRepository extends Model
{
    protected $useTimestamps = true;
    protected $table         = 'master_course';
    protected $returnType    = 'App\Repositories\Entities\CourseEntity';
}