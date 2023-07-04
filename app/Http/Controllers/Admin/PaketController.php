<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Paket;

class PaketController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            try {
                $data_request = [
                    'nama' => $this->postField('nama'),
                    'harga' => $this->postField('harga'),
                    'estimasi_hari' => $this->postField('estimasi'),
                    'deskripsi' => $this->postField('deskripsi'),
                ];
                Paket::create($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Paket::all();
            return $this->basicDataTables($data);
        }
        return view('admin.paket.index');
    }

    public function patch($id)
    {
        try {
            $data = Paket::find($id);
            $data_request = [
                'nama' => $this->postField('nama'),
                'harga' => $this->postField('harga'),
                'estimasi_hari' => $this->postField('estimasi'),
                'deskripsi' => $this->postField('deskripsi'),
            ];
            $data->update($data_request);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            Paket::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
