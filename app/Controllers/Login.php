<?php


namespace App\Controllers;


use App\Models\Member\MemberModel;
use App\Repositories\MemberRepository;
use CodeIgniter\RESTful\ResourcePresenter;

class Login extends ResourcePresenter
{

    private MemberModel $memberModel;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        $memberRepository = new MemberRepository();
        $this->memberModel = new MemberModel($memberRepository);
    }

    public function index()
    {
        $isLoginFailed = session('isLoginFailed');
        $failedLoginMessage = session('failedLoginMessage');
        $data = [
            'isLoginFailed' => $isLoginFailed,
            'failedLoginMessage' => $failedLoginMessage
        ];
        echo view('login', $data);
    }

    public function auth(){
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");
        $memberOutput = $this->memberModel->auth($email, $password);

        session()->set('loginResponse', $memberOutput);
        return redirect()->to("/");
    }
}