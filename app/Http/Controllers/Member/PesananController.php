<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Paket;
use App\Models\Pesanan;
use Carbon\Carbon;

class PesananController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pesanan::with(['paket'])
            ->where('user_id', '=', auth()->id())
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('member.pesanan')->with(['data' => $data]);
    }


    public function paket($id)
    {
        $data = Paket::findOrFail($id);
        if ($this->request->method() === 'POST') {
            try {
                $data_request = [
                    'user_id' => auth()->id(),
                    'paket_id' => $data->id,
                    'tanggal' => Carbon::now(),
                    'no_pesanan' => 'PSN-'.Carbon::now()->format('YmdHis'),
                    'berat' => 0,
                    'harga' => $data->harga,
                    'total' => 0,
                    'alamat' => $this->postField('alamat'),
                    'status' => 0,
                ];
                Pesanan::create($data_request);
                return redirect()->back()->with('success', 'berhasil');
            }catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with('failed', 'terjadi kesalahan server');
            }
        }
        return view('member.pesan-paket')->with(['data' => $data]);
    }
}
