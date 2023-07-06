@extends('member.layout')

@section('content')
    <div style="min-height: 500px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb"  style="background-color: transparent !important;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data->nama }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('js')
@endsection
