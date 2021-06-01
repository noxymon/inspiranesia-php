<?php


namespace App\Models\Course\Output;


class CourseOutput
{
    public string $id; //String
    public int $capacity = 1; //String
    public $courseDescription; //String
    public $courseEndDate; //Date
    public $courseEndTime; //String
    public string $courseName; //String
    public $courseStartDate; //Date
    public $courseStartTime; //String
    public $courseType; //String
    public $instructorDescription; //String
    public $instructorName; //String
    public $latitude; //array( undefined )
    public $longitude; //array( undefined )
    public $published; //String
    public $userCreated; //String
    public $userUpdated; //array( undefined )
    public $webinarLink; //String
    public $passcode; //array( undefined )
    public $meetingId; //array( undefined )
    public $courseOutline; //array( undefined )
    public $publicAccess; //String
    public $frontBanner; //array( undefined )
    public $courseDetailBanner; //array( undefined )
    public $instructorPhoto;
    public $floorImage;
    public $detailImage;
    public string $courseStartUrl;
    public int $registeredCount = 0;
    public bool $isAlreadyJoined = false;
    public bool $isAlreadyStart = false;
    public bool $isOpenForRegistration = false;
    public int $daysBeforeStartDate = 0;
    public int $daysBeforeCloseDate = 0;

    /**
     * CourseOutput constructor.
     * @param $id
     * @param $courseName
     */
    public function __construct(string $id, string $courseName)
    {
        $this->id = $id;
        $this->courseName = $courseName;
    }
}