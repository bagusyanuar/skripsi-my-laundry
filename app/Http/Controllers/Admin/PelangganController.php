<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pelanggan;
use App\Models\User;

class PelangganController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Pelanggan::with(['user'])->get();
            return $this->basicDataTables($data);
        }
        return view('admin.pelanggan.index');
    }
}
