@extends('member.layout')

@section('css')
    <style>
        .order-left {
            min-height: 400px;
            border: solid 1px #03045E;
            border-radius: 10px;
            padding: 10px 20px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil", 'Berhasil Membuat Pesanan', "success").then((r) => {
                window.location.href = '/pesanan';
            })
        </script>
    @endif
    <div style="min-height: 500px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent !important;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data->nama }}</li>
            </ol>
        </nav>
        <div class="pt-2 pl-3 pr-3 pb-3 w-100">
            <div class="row">
                <div class="col-8">
                    <div class="order-left">
                        <p style="font-size: 24px; color: #777777; font-weight: bold;">{{ $data->nama }}</p>
                        <p style="font-size: 14px; color: #777777;">Estimasi Pelayanan
                            Laundry {{ $data->estimasi_hari }} hari</p>
                        <p style="font-size: 14px; color: #777777;">Deskripsi : {{ $data->deskripsi }}</p>
                        <p class="mb-0" style="font-size: 30px; font-weight: bold; color: #0c5460;">
                            Rp. {{ number_format($data->harga, 0, ',', '.') }} /KG</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <p style="font-size: 16px; color: #777777; font-weight: bold;">Data Pemesanan</p>
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="harga"
                                       name="berat" value="{{ $data->harga }}">
{{--                                <div class="w-100 mb-1">--}}
{{--                                    <label for="berat" class="form-label">Berat Pakaian (Kg)</label>--}}
{{--                                    <input type="number" class="form-control" id="berat" placeholder="Berat"--}}
{{--                                           name="berat" value="0" required>--}}
{{--                                </div>--}}
{{--                                <div class="w-100 mb-1">--}}
{{--                                    <label for="total" class="form-label">Total (Rp)</label>--}}
{{--                                    <input type="number" class="form-control" id="total" placeholder="Total"--}}
{{--                                           name="total" value="0" readonly>--}}
{{--                                </div>--}}
                                <div class="w-100 mb-1">
                                    <label for="alamat" class="form-label">Alamat Pengambilan</label>
                                    <textarea type="text" class="form-control" id="alamat" placeholder="Alamat"
                                           name="alamat" required>{{ auth()->user()->pelanggan->alamat }}</textarea>
                                </div>
                                <hr>
{{--                                <div class="form-group w-100 mb-1">--}}
{{--                                    <label for="bank">Bank</label>--}}
{{--                                    <select class="form-control" id="bank" name="bank" required>--}}
{{--                                        <option value="BCA">BCA</option>--}}
{{--                                        <option value="Mandiri">Mandiri</option>--}}
{{--                                        <option value="BRI">BRI</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="w-100 mb-1">--}}
{{--                                    <label for="atas_nama" class="form-label">Atas Nama</label>--}}
{{--                                    <input type="text" class="form-control" id="atas_nama" placeholder="Atas Nama"--}}
{{--                                           name="atas_nama" required>--}}
{{--                                </div>--}}
{{--                                <div class="w-100 mb-1">--}}
{{--                                    <label for="no_rekening" class="form-label">No. Rekening</label>--}}
{{--                                    <input type="number" class="form-control" id="no_rekening" placeholder="No. Rekening"--}}
{{--                                           name="no_rekening" required>--}}
{{--                                </div>--}}
{{--                                <div class="w-100 mb-1">--}}
{{--                                    <label for="bukti" class="form-label">Bukti--}}
{{--                                        Transfer</label>--}}
{{--                                    <input type="file" class="form-control-file" id="bukti"--}}
{{--                                           placeholder="Gambar Bukti"--}}
{{--                                           name="bukti" required>--}}
{{--                                </div>--}}
                                <hr>
                                <button id="btn-pesan" type="submit"
                                        class="btn btn-primary d-flex justify-content-center align-items-center w-100 mt-3">
                                    <span class="font-weight-bold">Pesan Sekarang</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        function getTotal() {
            let berat = $('#berat').val() === '' ? '0' : $('#berat').val();
            let harga = $('#harga').val();
            let intBerat = parseInt(berat);
            let intHarga = parseInt(harga);
            let total = intBerat * intHarga;
            $('#total').val(total);
        }

        $(document).ready(function () {

            $('#berat').on('input', function () {
                getTotal();
            })
        })
    </script>
@endsection
