<?php


namespace App\Repositories;


use CodeIgniter\Model;

class CourseMemberAttendanceRepository extends Model
{
    protected $useTimestamps = true;
    protected $table         = 'transaction_course_member_attendence';
    protected $allowedFields = ['transaction_id','amount','amount_final','course_id','discount',
        'expired_at','member_id','paid_at','transaction_status'
    ];
    protected $createdField  = 'created_date';
    protected $updatedField  = 'updated_date';
    protected $deletedField  = '';
    protected $returnType    = 'App\Repositories\Entities\CourseMemberAttendanceEntity';
}