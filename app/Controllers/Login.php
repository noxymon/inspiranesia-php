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
        $previousUrlParam = $this->request->getVar("prevUrl");

        $previousUrl = "/";
        if(!is_null($previousUrlParam)){
            $previousUrl = $previousUrlParam;
        }

        $data = [
            'isLoginFailed' => $isLoginFailed,
            'failedLoginMessage' => $failedLoginMessage,
            'previousUrl' => $previousUrl
        ];
        echo view('login', $data);
    }

    public function auth(){
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");
        $previousUrlParam = $this->request->getVar("previousUrl");
        $memberOutput = $this->memberModel->auth($email, $password);

        session()->set('loginResponse', $memberOutput);
        return redirect()->to($previousUrlParam);
    }
}