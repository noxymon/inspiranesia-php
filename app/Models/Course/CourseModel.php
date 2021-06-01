<?php


namespace App\Models\Course;


use App\Models\Course\Output\CourseOutput;
use App\Repositories\CourseMemberAttendanceRepository;
use App\Repositories\CourseRepository;
use App\Repositories\Entities\CourseEntity;
use App\Repositories\Entities\CourseMemberAttendanceEntity;
use Michalsn\Uuid\Uuid;

class CourseModel
{
    private Uuid $uuidGenerator;
    private CourseRepository $courseRepository;
    private CourseMemberAttendanceRepository  $courseMemberAttendanceRepository;

    public function __construct(CourseRepository $courseRepository,
                                CourseMemberAttendanceRepository $courseMemberAttendanceRepository) {
        $this->uuidGenerator = service('uuid');
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
        if(is_null($courseDetail)){
            throw new \Exception("Course not exist");
        }

        return $this->mapEntityToOutput($courseDetail);
    }

    public function getCourseDetailByAndMember(string $id, string $memberId): CourseOutput{
        $courseDetail = $this->courseRepository->find($id);
        if(is_null($courseDetail)){
            throw new \Exception("Course not exist");
        }

        $isAlreadyJoined = $this->isAlreadyJoined($memberId, $courseDetail);
        $courseOutput = $this->mapEntityToOutput($courseDetail);
        $courseOutput->isAlreadyJoined = $isAlreadyJoined;
        return $courseOutput;
    }

    public function joinCourse(string $memberId, string $courseId): bool {
        $courseDetail = $this->getCourseDetailBy($courseId);
        $courseMemberAttendance = new CourseMemberAttendanceEntity();
        $courseMemberAttendance->transaction_id = $this->uuidGenerator->uuid4();
        $courseMemberAttendance->member_id=$memberId;
        $courseMemberAttendance->course_id = $courseDetail->id;
        $courseMemberAttendance->discount = 0;
        $courseMemberAttendance->amount = 0;
        $courseMemberAttendance->amount_final = 0;
        $courseMemberAttendance->paid_at = (new \DateTime("now"))->format(DATE_ATOM);
        $courseMemberAttendance->transaction_status=2;
        return $this->courseMemberAttendanceRepository->save($courseMemberAttendance);
    }

    private function mapEntityToOutput(CourseEntity $course): CourseOutput
    {
        $courseOutput = new CourseOutput($course->id, $course->course_name);
        $courseOutput->capacity= $course->capacity - $this->calculateParticipantInCourseById($course->id);
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
        $courseOutput->daysBeforeStartDate = $this->calculateIntervalFromNowToStart($course);
        $courseOutput->isAlreadyStart = $this->isCourseHasStarted($course);
        $courseOutput->isOpenForRegistration = $this->isCourseOpenRegistration($course);
        $courseOutput->courseStartUrl = $course->id."/start";
        return $courseOutput;
    }

    private function calculateIntervalFromNowToStart(CourseEntity $course): int
    {
        $today = new \DateTime("now");
        $courseStartDate = new \DateTime($course->course_start_date);
        return $today->diff($courseStartDate)->format("%r%a");
    }

    private function isCourseOpenRegistration(CourseEntity $course):bool {
        $today = new \DateTime("now");
        $courseStartTime = new \DateTime($course->course_end_date." ".$course->course_end_time);
        $differentMinute = ($courseStartTime->getTimestamp()-$today->getTimestamp())/60;
        if($differentMinute >=15){
            return true;
        }
        return false;
    }

    private function isAlreadyJoined(string $memberId, CourseEntity  $courseEntity):bool {
        $matchedCourseAttendance = $this->courseMemberAttendanceRepository
            ->where('course_id', $courseEntity->id)
            ->where('member_id', $memberId)
            ->where('transaction_status', 2)
            ->countAllResults();
        return $matchedCourseAttendance > 0;
    }

    private function isCourseHasStarted(CourseEntity $course): bool
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

    private function calculateParticipantInCourseById(string $courseId): int{
        return $this->courseMemberAttendanceRepository->where("course_id", $courseId)->countAllResults();
    }
}