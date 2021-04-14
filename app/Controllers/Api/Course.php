<?php


namespace App\Controllers\Api;


use App\Models\Course\CourseModel;
use App\Repositories\CourseMemberAttendanceRepository;
use App\Repositories\CourseRepository;
use CodeIgniter\RESTful\ResourceController;

class Course extends ResourceController
{
    protected $model;
    protected $format    = 'json';

    public function __construct()
    {
        $courseRepository = new CourseRepository();
        $courseMemberAttendaceRepository = new CourseMemberAttendanceRepository();
        $this->model = new CourseModel($courseRepository, $courseMemberAttendaceRepository);
    }

    public function index(){
        $allCourse = $this->model->getAllCourse();
        return $this->respond($allCourse);
    }

    public function show($id = null)
    {
        $courseDetailById = $this->model->getCourseDetailBy($id);
        return $this->respond($courseDetailById);
    }
}