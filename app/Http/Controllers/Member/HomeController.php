<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Paket;

class HomeController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $pakets = Paket::all();
        return view('member.home')->with(['pakets' => $pakets]);
    }
}
