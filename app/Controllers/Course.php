<?php

namespace App\Controllers;

use App\Models\Course\CourseModel;
use App\Repositories\CourseMemberAttendanceRepository;
use App\Repositories\CourseRepository;
use CodeIgniter\RESTful\ResourcePresenter;

class Course extends ResourcePresenter
{
    protected $model;

    public function __construct()
    {
        $courseRepository = new CourseRepository();
        $courseMemberAttendaceRepository = new CourseMemberAttendanceRepository();
        $this->model = new CourseModel($courseRepository, $courseMemberAttendaceRepository);
    }

    public function index()
	{
        $data = [
	        'course_list' =>  $this->model->getAllCourse(),
        ];
	    echo view('homepage', $data);
	}

    public function show($id = null)
    {
        $session = session("loginResponse");
        $data = [
            'courseDetail' =>  $this->model->getCourseDetailByAndMember($id, $session->id),
            'loginResponse' => $session
        ];
        echo view('course-detail', $data);
    }

    public function start($id){
        $data = null;
        echo view('course-start', $data);
    }
}
