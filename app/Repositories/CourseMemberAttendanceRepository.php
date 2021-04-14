<?php


namespace App\Repositories;


use CodeIgniter\Model;

class CourseMemberAttendanceRepository extends Model
{
    protected $useTimestamps = true;
    protected $table         = 'transaction_course_member_attendence';
    protected $returnType    = 'App\Repositories\Entities\CourseMemberAttendanceEntity';
}