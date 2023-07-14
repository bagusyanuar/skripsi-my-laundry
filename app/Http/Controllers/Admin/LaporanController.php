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

    public function cetak_pesanan()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = $data = Pesanan::with(['user.pelanggan', 'paket'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->orderBy('created_at', 'ASC')
            ->get();
        $html = view('admin.cetak.pesanan')->with(['data' => $data, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function pendapatan()
    {
        if ($this->request->ajax()) {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Pesanan::with(['user.pelanggan', 'paket'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->where('status', '=', 9)
                ->orderBy('created_at', 'ASC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.pendapatan');
    }

    public function cetak_pendapatan()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Pesanan::with(['user.pelanggan', 'paket'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->where('status', '=', 9)
            ->orderBy('created_at', 'ASC')
            ->get();
        $html = view('admin.cetak.pendapatan')->with(['data' => $data, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
