<?php

namespace App\Controllers;

use App\Models\Course\CourseModel;
use App\Repositories\CourseRepository;
use CodeIgniter\RESTful\ResourcePresenter;

class Course extends ResourcePresenter
{
    protected $model;

    public function __construct()
    {
        $courseRepository = new CourseRepository();
        $this->model = new CourseModel($courseRepository);
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
        $data = [
            'courseDetail' =>  $this->model->getCourseDetailBy($id),
            'loginResponse' => session("loginResponse")
        ];
        echo view('course-detail', $data);
    }
}
