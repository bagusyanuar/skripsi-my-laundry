<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        return view('member.login');
    }
}
