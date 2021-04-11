<?php


namespace App\Controllers;


use CodeIgniter\RESTful\ResourcePresenter;

class Logout extends ResourcePresenter
{
    public function index()
    {
        session()->destroy();
        return redirect()->to(index_page());
    }
}