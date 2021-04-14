<?php


namespace App\Models\Course;


use App\Models\Course\Output\CourseOutput;
use App\Repositories\CourseMemberAttendanceRepository;
use App\Repositories\CourseRepository;

class CourseModel
{
    private CourseRepository $courseRepository;
    private CourseMemberAttendanceRepository  $courseMemberAttendanceRepository;

    public function __construct(CourseRepository $courseRepository, CourseMemberAttendanceRepository $courseMemberAttendanceRepository) {
        $this->courseRepository = $courseRepository;
        $this->courseMemberAttendanceRepository = $courseMemberAttendanceRepository;
    }

    public function getAllCourse(): array {
        $allCourse = $this->courseRepository->findAll();

        $courseOutputArray = [];
        foreach ($allCourse as $course){
            $courseOutput = $this->mapEntityToOutput($course);
            array_push($courseOutputArray, $courseOutput);
        }
        return $courseOutputArray;
    }

    public function getCourseDetailBy(string $id): CourseOutput{
        $courseDetail = $this->courseRepository->find($id);
        $this->courseMemberAttendanceRepository->getWhere();
        return $this->mapEntityToOutput($courseDetail);
    }

    private function mapEntityToOutput($course): CourseOutput
    {
        $courseOutput = new CourseOutput($course->id, $course->course_name);
        $courseOutput->capacity= $course->capacity;
        $courseOutput->courseDescription= $course->course_description;
        $courseOutput->courseDetailBanner= $course->course_detail_banner;
        $courseOutput->courseEndDate= $course->course_end_date;
        $courseOutput->courseEndTime= $course->course_end_time;
        $courseOutput->courseOutline= $course->course_outline;
        $courseOutput->courseStartDate= $course->course_start_date;
        $courseOutput->courseStartTime= $course->course_start_time;
        $courseOutput->courseType= $course->course_type;
        $courseOutput->frontBanner= $course->front_banner;
        $courseOutput->instructorDescription= $course->instructor_description;
        $courseOutput->instructorName= $course->instructor_name;
        $courseOutput->instructorPhoto= $course->instructor_photo;
        $courseOutput->latitude= $course->latitude;
        $courseOutput->longitude= $course->longitude;
        $courseOutput->meetingId= $course->meeting_id;
        $courseOutput->passcode= $course->passcode;
        $courseOutput->publicAccess= $course->public_access;
        $courseOutput->published= $course->published;
        $courseOutput->userCreated= $course->user_created;
        $courseOutput->userUpdated= $course->user_udpated;
        $courseOutput->webinarLink= $course->webinar_link;
        $courseOutput->floorImage = '/images/hp_display_'.rand(0,5).'.jpeg';
        $courseOutput->detailImage = '/images/cd_display_'.rand(0,5).'.jpeg';
        $courseOutput->daysBeforeStartDate = $this->calculateIntervalFromNowToStart($course)->days;
        $courseOutput->isAlreadyStart = $this->isCourseHasStarted($course);
        return $courseOutput;
    }

    private function calculateIntervalFromNowToStart($course)
    {
        $today = new \DateTime("now");
        $courseStartDate = new \DateTime($course->course_start_date);
        return date_diff($today, $courseStartDate, false);
    }

    private function isCourseHasStarted($course): bool
    {
        $isCourseHasStarted = false;
        $now = new \DateTime("now");
        $courseStartTime = new \DateTime($course->course_start_date." ".$course->course_start_time);
        $courseEndTime = new \DateTime($course->course_end_date." ".$course->course_end_time);
        if ($now >= $courseStartTime && $now < $courseEndTime) {
            $isCourseHasStarted = true;
        }
        return $isCourseHasStarted;
    }
}