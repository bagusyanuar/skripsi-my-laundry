@extends('admin.layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Paket Layanan</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Paket Layanan
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="text-right mb-2">
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i
                            class="fa fa-plus mr-1"></i><span
                            class="font-weight-bold">Tambah</span></a>
                </div>
            </div>
            <div class="card-body">
                <table id="table-data" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th>Nama</th>
                        <th width="15%">Harga (Rp.)</th>
                        <th width="15%">Estimasi (hari)</th>
                        <th>Deskripsi</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Paket Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="w-100 mb-1">
                        <label for="nama" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama Paket"
                               name="nama">
                    </div>
                    <div class="w-100 mb-1">
                        <label for="harga" class="form-label">Harga (Rp.)</label>
                        <input type="number" class="form-control" id="harga" placeholder="Harga Paket"
                               name="harga">
                    </div>
                    <div class="w-100 mb-1">
                        <label for="estimasi" class="form-label">Estimasi (hari)</label>
                        <input type="number" class="form-control" id="estimasi" placeholder="Estimasi Layanan"
                               name="estimasi">
                    </div>
                    <div class="w-100 mb-1">
                        <label for="deskripsi" class="form-label">Deskripsi Paket</label>
                        <textarea rows="3" class="form-control" id="deskripsi" placeholder="Deskripsi Paket"
                                  name="deskripsi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="btn-save" type="button" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Paket Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id="id" name="id" value="">
                <div class="modal-body">
                    <div class="w-100 mb-1">
                        <label for="nama-edit" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="nama-edit" placeholder="Nama Paket"
                               name="nama-edit">
                    </div>
                    <div class="w-100 mb-1">
                        <label for="harga-edit" class="form-label">Harga (Rp.)</label>
                        <input type="number" class="form-control" id="harga-edit" placeholder="Harga Paket"
                               name="harga-edit">
                    </div>
                    <div class="w-100 mb-1">
                        <label for="estimasi-edit" class="form-label">Estimasi (hari)</label>
                        <input type="number" class="form-control" id="estimasi-edit" placeholder="Estimasi Layanan"
                               name="estimasi-edit">
                    </div>
                    <div class="w-100 mb-1">
                        <label for="deskripsi-edit" class="form-label">Deskripsi Paket</label>
                        <textarea rows="3" class="form-control" id="deskripsi-edit" placeholder="Deskripsi Paket"
                                  name="deskripsi-edit"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="btn-patch" type="button" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var table;

        function clear() {
            $('#nama').val('');
            $('#harga').val('');
            $('#estimasi').val('');
            $('#deskripsi').val('');
            $('#nama-edit').val('');
            $('#harga-edit').val('');
            $('#estimasi-edit').val('');
            $('#deskripsi-edit').val('');
            $('#id').val('');
        }

        function store() {
            let url = '{{ route('paket') }}';
            let data = {
                nama: $('#nama').val(),
                harga: $('#harga').val(),
                estimasi: $('#estimasi').val(),
                deskripsi: $('#deskripsi').val(),
            };
            AjaxPost(url, data, function () {
                clear();
                SuccessAlert('Berhasil!', 'Berhasil menyimpan data...');
                reload();
            });
        }

        function patch() {
            let id = $('#id').val();
            let url = '{{ route('paket') }}' + '/' + id;
            let data = {
                nama: $('#nama-edit').val(),
                harga: $('#harga-edit').val(),
                estimasi: $('#estimasi-edit').val(),
                deskripsi: $('#deskripsi-edit').val(),
            };
            AjaxPost(url, data, function () {
                clear();
                $('#modalEdit').modal('hide');
                SuccessAlert('Berhasil!', 'Berhasil merubah data...');
                reload();
            });
        }

        function destroy(id) {
            let url = '{{ route('paket') }}' + '/' + id + '/delete';
            AjaxPost(url, {}, function () {
                clear();
                SuccessAlert('Berhasil!', 'Berhasil menghapus data...');
                reload();
            });
        }

        function reload() {
            table.ajax.reload();
        }

        function editEvent() {
            $('.btn-edit').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                let nama = this.dataset.nama;
                let harga = this.dataset.harga;
                let estimasi = this.dataset.estimasi;
                let deskripsi = this.dataset.deskripsi;
                $('#nama-edit').val(nama);
                $('#harga-edit').val(harga);
                $('#estimasi-edit').val(estimasi);
                $('#deskripsi-edit').val(deskripsi);
                $('#id').val(id);
                $('#modalEdit').modal('show');
            })
        }


        function deleteEvent() {
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menghapus data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        destroy(id);
                    }
                });

            })
        }

        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/paket', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'nama'},
                {
                    data: 'harga', render: function (data) {
                        return data.toLocaleString('id-ID');
                    },
                },
                {data: 'estimasi_hari'},
                {data: 'deskripsi'},
                {
                    data: null, render: function (data) {
                        return '<a href="#" class="btn btn-sm btn-warning btn-edit mr-1" data-id="' + data['id'] + '" data-nama="' + data['nama'] + '" data-harga="' + data['harga'] + '" data-estimasi="' + data['estimasi_hari'] + '" data-deskripsi="' + data['deskripsi'] + '"><i class="fa fa-edit f12"></i></a>' +
                            '<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="' + data['id'] + '"><i class="fa fa-trash f12"></i></a>';
                    }
                },
            ], [
                {
                    targets: [0, 3, 5],
                    className: 'text-center'
                },
                {
                    targets: [2],
                    className: 'text-right'
                },
            ], function (d) {
            }, {
                "fnDrawCallback": function (setting) {
                    editEvent();
                    deleteEvent();
                }
            });

            $('#btn-save').on('click', function () {
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menyimpan data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        store();
                    }
                });
            });
            $('#btn-patch').on('click', function () {
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin merubah data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        patch();
                    }
                });
            });
            deleteEvent();
            $('#modalAdd').on('hidden.bs.modal', function (e) {
                clear();
            });
            $('#modalEdit').on('hidden.bs.modal', function (e) {
                clear();
            })
        });
    </script>
@endsection
