<?php


namespace App\Controllers\Api;


use App\Repositories\MemberRepository;
use CodeIgniter\RESTful\ResourceController;

class Member extends ResourceController
{

    protected $model;
    protected $format    = 'json';

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