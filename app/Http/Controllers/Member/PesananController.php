<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Paket;

class PesananController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function paket($id)
    {
        $data = Paket::findOrFail($id);
        return view('member.pesan-paket')->with(['data' => $data]);
    }
}
