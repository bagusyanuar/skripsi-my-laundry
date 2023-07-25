@extends('admin.cetak.index')

@section('content')
    <div class="text-center report-title">LAPORAN PESANAN LAUNDRY</div>
    <div class="text-center text-body font-weight-bold">Periode {{ $tgl1 }} - {{ $tgl2 }}</div>
    <hr>
    <table id="my-table" class="table display" style="margin-top: 10px">
        <thead>
        <tr>
            <th width="5%" class="text-center text-body-small">#</th>
            <th width="8%" class="text-center text-body-small ">Tanggal</th>
            <th width="10%" class="text-center text-body-small">No. Pesanan</th>
            <th width="10%" class="text-body-small">Nama Pelanggan</th>
            <th width="15%" class="text-body-small">Paket</th>
            <th width="7%" class="text-right text-body-small">Harga (Rp.)</th>
            <th width="7%" class="text-center text-body-small">Berat (Kg)</th>
            <th width="7%" class="text-right text-body-small">Total (Rp.)</th>
            <th class="text-body-small">Alamat</th>
            <th width="10%" class="text-center text-body-small">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center text-body-small">{{ $loop->index + 1 }}</td>
                <td class="text-center text-body-small">{{ $v->tanggal }}</td>
                <td class="text-center text-body-small">{{ $v->no_pesanan }}</td>
                <td class="text-body-small">{{ $v->user->username }}</td>
                <td class="text-body-small">{{ $v->paket->nama }}</td>
                <td class="text-right text-body-small">{{ number_format($v->harga, 0, ',', '.') }}</td>
                <td class="text-center text-body-small">{{ number_format($v->berat, 0, ',', '.')}}</td>
                <td class="text-right text-body-small">{{ number_format($v->total, 0, ',', '.') }}</td>
                <td class="text-body-small">{{ $v->alamat }}</td>
                <td class="text-center text-body-small">
                    @switch($v->status)
                        @case(0)
                        <span>menunggu</span>
                        @break
                        @case(1)
                        <span>di proses</span>
                        @break
                        @case(2)
                        <span>selesai</span>
                        @break
                        @case(3)
                        <span>di kirim</span>
                        @break
                        @case(6)
                        <span>di tolak</span>
                        @break
                        @case(9)
                        <span>di terima</span>
                        @break
                        @default
                        <span>-</span>
                        @break
                    @endswitch
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="col-xs-8 f-bold report-header-sub-title" style="text-align: right;"></div>
        <div class="col-xs-3 f-bold text-body-small" style="text-align: center;">
            Surakarta, {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-8 f-bold report-header-sub-title" style="text-align: right;"></div>
        <div class="col-xs-3 f-bold text-body-small" style="text-align: center;">(Admin)</div>
    </div>
@endsection
