<?php


namespace App\Models\Member;


use App\Models\Member\Output\MemberOutput;
use App\Repositories\MemberRepository;
use Exception;

class MemberModel
{
    private MemberRepository $memberRepository;

    /**
     * MemberModel constructor.
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function auth(string $email, string $password): MemberOutput {
        $matchedUser = $this->memberRepository->getWhere(['email'=>$email, 'password'=>$password])->getRow();
        if($matchedUser == null){
            throw new Exception("Ups, email dan password anda salah");
        }
        return $this->mapToOutput($matchedUser);
    }

    private function mapToOutput($matchedUser): MemberOutput
    {
        $memberOutput = new MemberOutput($matchedUser->id, $matchedUser->email);
        $memberOutput->password = $matchedUser->password;
        $memberOutput->active = $matchedUser->active;
        $memberOutput->createDate = $matchedUser->create_date;
        $memberOutput->dateOfBirth = $matchedUser->date_of_birth;
        $memberOutput->firstName = $matchedUser->first_name;
        $memberOutput->lastName = $matchedUser->last_name;
        $memberOutput->memberType = $matchedUser->member_type;
        $memberOutput->updateDate = $matchedUser->update_date;
        $memberOutput->userCreated = $matchedUser->user_created;
        $memberOutput->userUpdated = $matchedUser->user_updated;
        return $memberOutput;
    }
}