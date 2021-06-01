<?php

namespace App\Controllers;

use App\Models\Course\CourseModel;
use App\Models\Course\Output\CourseOutput;
use App\Models\Member\Output\MemberOutput;
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
        $courseOutput = $this->getCourseDetail($id, $session);
        $data = [
            'courseDetail' => $courseOutput,
            'loginResponse' => $session
        ];
        echo view('course-detail', $data);
    }

    public function start($id = null){
        $session = session("loginResponse");
        if(is_null($session)){
            return redirect()->to('/login');
        }

        $fullName = $session->firstName.' '.$session->lastName;
        $courseDetail = $this->getCourseDetail($id, $session);
        $data = [
            'courseDetail'=> $courseDetail,
        ];

        $useFallbackFlag = $this->getFallbackFlag();
        if($useFallbackFlag){
            echo view('fallback-course', $data);
        }

        $data['courseStartUrl'] = $this->generateCourseStartUrl($courseDetail, $fullName);
        echo view('course-start', $data);
    }

    private function getCourseDetail($id, $session): CourseOutput
    {
        $courseOutput = $this->model->getCourseDetailBy($id);
        if (!is_null($session)) {
            $courseOutput = $this->model->getCourseDetailByAndMember($id, $session->id);
        }
        return $courseOutput;
    }

    private function getFallbackFlag(): bool
    {
        return (bool)$this->request->getVar("useFallback");
    }

    private function generateCourseStartUrl(CourseOutput $courseDetail, string $fullName): string
    {
        $isMobile = $this->request->getUserAgent()->isMobile();
        $courseStartUrl = 'zoommtg://zoom.us/join?confno=' . $courseDetail->meetingId . '&pwd=' . $courseDetail->passcode .
            '&zc=0&uname=' . $fullName;
        if ($isMobile) {
            $courseStartUrl = "zoomus://zoom.us/join?confno=" . $courseDetail->meetingId . "&pwd=" . $courseDetail->passcode .
                "&zc=0&uname=" . $fullName;
        }
        return $courseStartUrl;
    }
}
