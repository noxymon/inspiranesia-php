<?php


namespace App\Controllers\Api;


use App\Models\Course\CourseModel;
use App\Repositories\CourseMemberAttendanceRepository;
use App\Repositories\CourseRepository;

class Course extends BaseApi
{
    protected $model;

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

    public function join($id){
        $hashValue = $this->request->getJsonVar("hash");
        $memberId = $this->request->getJsonVar("memberId");
        try {
            if ($this->validateHash($hashValue, $memberId)) {
                $success = $this->model->joinCourse($memberId, $id);
                if(!$success){
                    return $this->failResourceGone();
                }
                return $this->respondCreated();
            }
        } catch (response\InvalidHashException $e) {
            return $this->failUnauthorized($e->getMessage());
        }
    }
}