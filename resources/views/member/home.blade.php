@extends('member.layout')

@section('content')
    <div class="hero-dark d-flex align-items-center">
        <div class="w-50 p-5 left-hero pr-5">
            <p style="font-size: 46px;">My Laundry</p>
            <p style="font-size: 20px; color: #a0aec0" class="mb-4">Selamat datang di sistem informasi penyedia jasa
                pemesanan laundry my
                laundry.</p>
            <a href="#paket" class="btn-register">Pesan Sekarang</a>
        </div>
        <div class="w-50 p-3 right-hero">
            <div class="w-100 text-center">
                <img src="{{ asset('/assets/hero.png') }}" height="400" alt="hero image">
            </div>
        </div>
    </div>
    <div class="text-center p-3">
        <p style="font-size: 20px; color: #777777; font-weight: bold; letter-spacing: 2px;">Paket Kami</p>
    </div>
    <section id="paket" class="pb-5 pl-3 pr-3">
        <div class="row justify-content-center w-100">
            @forelse($pakets as $paket)
                <div class="col-3">
                    <div class="card-paket shadow-lg d-flex flex-column align-items-center justify-content-between">
                        <p style="font-size: 16px; color: #777777; font-weight: bold;">{{ $paket->nama }}</p>
                        <div class="">
                            <div class="text-center">
                                <p class="mb-0" style="font-size: 30px; font-weight: bold; color: #0c5460;">
                                    Rp. {{ number_format($paket->harga, 0, ',', '.') }} /KG</p>
                                <p style="font-size: 16px; color: #777777; font-weight: bold;">{{ $paket->estimasi_hari }}
                                    hari</p>
                            </div>
                            <p class="text-justify" style="text-overflow: ellipsis">
                                {{ $paket->deskripsi }}
                            </p>
                        </div>
                        <a href="#" data-id="{{ $paket->id }}" class="card-paket-button btn-pesan">Pesan Sekarang</a>
                    </div>
                </div>
            @empty
                <div style="height: 200px;" class="d-flex justify-content-center align-items-center">
                    <p style="font-size: 16px; color: #777777; font-weight: bold;">Belum Ada Paket Tersedia</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection

@section('js')
    <script>

        $(document).ready(function () {
            $('.btn-pesan').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                window.location.href = '/pesan-paket/'+id;
            })
        });
    </script>
@endsection
