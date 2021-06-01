<?php


namespace App\Controllers\Api;


use App\Repositories\MemberRepository;

class Member extends BaseApi
{

    protected $model;

    /**
     * Member constructor.
     * @param $model
     */
    public function __construct()
    {
        $this->model = new MemberRepository();
    }

    public function index(){
        return $this->respond($this->model->findAll());
    }

    public function show($id = null){
        return $this->respond($this->model->find($id));
    }
}