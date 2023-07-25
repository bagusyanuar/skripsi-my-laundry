@extends('member.layout')

@section('content')
    <div style="min-height: 500px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent !important;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
            </ol>
        </nav>
        <div class="p-3">
            <p style="font-size: 18px; color: #777777; font-weight: bold;">Riwayat Pesanan</p>
            <table id="table-data" class="display w-100 table table-bordered" style="font-size: 12px;">
                <thead>
                <th width="5%" class="text-center">#</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">No. Transaksi</th>
                <th width="12%">Nama Paket</th>
                <th class="text-right">Harga (Rp.)</th>
                <th class="text-center">Berat (KG)</th>
                <th class="text-right">Total (Rp.)</th>
                <th>Alamat</th>
                <th class="text-center">Status</th>
                <th width="5%" class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td class="text-center">{{ $v->tanggal }}</td>
                        <td class="text-center">{{ $v->no_pesanan }}</td>
                        <td>{{ $v->paket->nama}}</td>
                        <td class="text-right">{{ number_format($v->harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $v->berat }}</td>
                        <td class="text-right">{{ number_format(($v->harga * $v->berat), 0, ',', '.') }}</td>
                        <td>{{ $v->alamat }}</td>
                        <td class="text-center">
                            @switch($v->status)
                                @case(0)
                                <span class="pt-1 pb-1 pl-3 pr-3"
                                      style="border-radius: 5px; background-color: #ffa505; color: white">Menunggu</span>
                                @break
                                @case(1)
                                <span class="pt-1 pb-1 pl-3 pr-3"
                                      style="border-radius: 5px; background-color: #1167b1; color: white">Di Proses</span>
                                @break
                                @case(2)
                                <span class="pt-1 pb-1 pl-3 pr-3"
                                      style="border-radius: 5px; background-color: #ee6c4d; color: white">Selesai</span>
                                @break
                                @case(3)
                                <span class="pt-1 pb-1 pl-3 pr-3"
                                      style="border-radius: 5px; background-color: #ff026e; color: white">Di Kirim</span>
                                @break
                                @case(6)
                                <span class="pt-1 pb-1 pl-3 pr-3"
                                      style="border-radius: 5px; background-color: #ff2424; color: white">Di Tolak</span>
                                @break
                                @case(9)
                                <span class="pt-1 pb-1 pl-3 pr-3"
                                      style="border-radius: 5px; background-color: #00a65a; color: white">Di Terima</span>
                                @break
                                @default
                                <span>-</span>
                            @endswitch
                        </td>
                        <td class="text-center">
                            @if($v->status != 9)
                                <a href="https://wa.me/62895422630233?text=Halo, Saya ingin menanyakan pesanan dengan nomor {{ $v->no_pesanan }}"
                                   target="_blank">
                                    <i class="fa fa-whatsapp" style="font-size: 14px;"></i>
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection
