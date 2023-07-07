<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pesanan;

class LaporanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pesanan()
    {
        if ($this->request->ajax()) {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Pesanan::with(['user.pelanggan', 'paket'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->orderBy('created_at', 'ASC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.pesanan');
    }
}
