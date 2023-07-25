<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pesanan;

class PesananController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function menunggu()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            try {
                $data = Pesanan::find($this->postField('id'));
                if (!$data) {
                    return $this->jsonResponse('failed ' . 'Pesanan Tidak DiTemukan...', 500);
                }


                $data_request = [
                    'status' => $this->postField('status'),
                    'alasan' => $this->postField('alasan'),
                ];

                if ($this->postField('status') == '1') {
                    $harga = $data->harga;
                    $total = $this->postField('berat') * $harga;
                    $data_request['berat'] = $this->postField('berat');
                    $data_request['total'] = $total;
                }
                $data->update($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Pesanan::with(['user.pelanggan', 'paket'])
                ->where('status', '=', 0)
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.pesanan.menunggu');
    }

    public function proses()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            try {
                $data = Pesanan::find($this->postField('id'));
                if (!$data) {
                    return $this->jsonResponse('failed ' . 'Pesanan Tidak DiTemukan...', 500);
                }
                $data_request = [
                    'status' => 2,
                ];
                $data->update($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Pesanan::with(['user.pelanggan', 'paket'])
                ->where('status', '=', 1)
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.pesanan.proses');
    }

    public function selesai()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            try {
                $data = Pesanan::find($this->postField('id'));
                if (!$data) {
                    return $this->jsonResponse('failed ' . 'Pesanan Tidak DiTemukan...', 500);
                }
                $data_request = [
                    'status' => 3,
                ];
                $data->update($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Pesanan::with(['user.pelanggan', 'paket'])
                ->where('status', '=', 2)
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.pesanan.selesai');
    }

    public function kirim()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            try {
                $data = Pesanan::find($this->postField('id'));
                if (!$data) {
                    return $this->jsonResponse('failed ' . 'Pesanan Tidak DiTemukan...', 500);
                }
                $data_request = [
                    'status' => 9,
                ];
                $data->update($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Pesanan::with(['user.pelanggan', 'paket'])
                ->where('status', '=', 3)
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.pesanan.kirim');
    }

    public function terima()
    {
        if ($this->request->ajax()) {
            $data = Pesanan::with(['user.pelanggan', 'paket'])
                ->where('status', '=', 9)
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.pesanan.terima');
    }
}
