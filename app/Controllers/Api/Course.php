<?php


namespace App\Controllers\Api;


use App\Models\Course\CourseModel;
use App\Repositories\CourseRepository;
use CodeIgniter\RESTful\ResourceController;

class Course extends ResourceController
{
    protected $model;
    protected $format    = 'json';

    public function __construct()
    {
        $courseRepository = new CourseRepository();
        $this->model = new CourseModel($courseRepository);
    }

    public function index(){
        $allCourse = $this->model->getAllCourse();
        return $this->respond($allCourse);
    }
}