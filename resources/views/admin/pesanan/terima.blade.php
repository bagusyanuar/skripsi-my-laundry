@extends('admin.layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pesanan Di Terima</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pesanan Di Terima
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            <div class="card-body">
                <table id="table-data" class="display w-100 table table-bordered" style="font-size: 12px">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="8%" class="text-center">Tanggal</th>
                        <th width="10%" class="text-center">No. Pesanan</th>
                        <th width="10%">Nama Pelanggan</th>
                        <th width="15%">Paket</th>
                        <th width="7%" class="text-right">Harga (Rp.)</th>
                        <th width="7%" class="text-center">Berat (Kg)</th>
                        <th width="7%" class="text-right">Total (Rp.)</th>
                        <th>Alamat</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var table;

        function reload() {
            table.ajax.reload();
        }


        $(document).ready(function () {
            let url = '{{ route('admin.pesanan.terima') }}';
            table = DataTableGenerator('#table-data', url, [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'tanggal'},
                {data: 'no_pesanan'},
                {data: 'user.username'},
                {data: 'paket.nama'},
                {
                    data: 'harga', render: function (data) {
                        return data.toLocaleString('id-ID');
                    }
                },
                {data: 'berat'},
                {
                    data: 'total', render: function (data) {
                        return data.toLocaleString('id-ID');
                    }
                },
                {data: 'alamat'},

            ], [
                {
                    targets: [0, 1, 2, 3, 6],
                    className: 'text-center'
                },
                {
                    targets: [5, 7],
                    className: 'text-right'
                },
            ], function (d) {
            }, {
                "fnDrawCallback": function (setting) {
                }
            });
        });

    </script>
@endsection
