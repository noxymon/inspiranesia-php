<?php

namespace App\Controllers;

use App\Models\Course\CourseModel;
use App\Repositories\CourseRepository;
use CodeIgniter\Model;
use CodeIgniter\RESTful\ResourcePresenter;

class Home extends ResourcePresenter
{
    protected $model;

    public function __construct()
    {
        helper('text');
        $courseRepository = new CourseRepository();
        $courseMemberAttendaceRepository = new CourseMemberAttendanceRepository();
        $this->model = new CourseModel($courseRepository, $courseMemberAttendaceRepository);
    }

    public function index()
	{
        $all = $this->model->getAllCourse();
        $data = [
	        'course_list' => $all,
            'loginResponse' => session('loginResponse')
        ];
	    echo view('homepage', $data);
	}
}
