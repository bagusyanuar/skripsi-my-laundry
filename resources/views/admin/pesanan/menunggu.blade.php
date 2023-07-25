@extends('admin.layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pesanan Menunggu</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pesanan Menunggu
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
                        <th width="12%" class="text-center">Tanggal</th>
                        <th width="15%" class="text-center">No. Pesanan</th>
                        <th width="15%">Nama Pelanggan</th>
                        <th width="15%">Paket</th>
                        <th width="10%" class="text-right">Harga (Rp.)</th>
                        <th width="10%" class="text-center">Berat (Kg)</th>
                        <th width="10%" class="text-right">Total (Rp.)</th>
                        <th>Alamat</th>
                        <th width="8%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="modalApproveLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalApproveLabel">Persetujuan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" value="">
                    <input type="hidden" id="phone" value="">
                    <input type="hidden" id="name" value="">
                    <input type="hidden" id="paket" value="">
                    <input type="hidden" id="harga" value="">
                    <div class="form-group w-100 mb-1">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Terima</option>
                            <option value="6">Tolak</option>
                        </select>
                    </div>
                    <div class="form-group w-100 mb-1" id="panel-alasan">
                        <label for="alasan">Alasan</label>
                        <textarea rows="3" class="form-control" id="alasan" placeholder=""
                                  name="alasan"></textarea>
                    </div>
                    <div class="form-group w-100 mb-1" id="panel-berat">
                        <label for="berat">Berat</label>
                        <input type="number" class="form-control" id="berat" placeholder="0"
                               name="berat">
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
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var table;

        function reload() {
            table.ajax.reload();
        }

        function eventApprove() {
            $('.btn-approve').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                let phone = this.dataset.phone;
                let name = this.dataset.name;
                let paket = this.dataset.paket;
                let harga = this.dataset.harga;
                console.log(name, paket, phone, harga);
                $('#id').val(id);
                $('#phone').val(phone);
                $('#name').val(name);
                $('#paket').val(paket);
                $('#harga').val(harga);
                $('#modalApprove').modal('show');
            });
        }

        function approveHandler() {
            let url = '{{ route('admin.pesanan.menunggu') }}';
            let data = {
                status: $('#status').val(),
                id: $('#id').val(),
                alasan: $('#alasan').val(),
                berat: $('#berat').val(),
            };
            AjaxPost(url, data, function () {
                let name = $('#name').val();
                let paket = $('#paket').val();
                let phone = $('#phone').val();
                let harga = $('#harga').val();
                let berat = $('#berat').val();
                let total = berat * harga;
                let text = 'Selamat, pesanan atas nama ' + name + ' paket pesanan ' + paket + ' berat pakaian ' + berat + '(KG) total biaya Rp. ' + total.toLocaleString('id-ID') + ' akan segera kami proses laundry';
                let url = 'https://wa.me/' + phone + '?text=' + text;
                let win = window.open(url, '_blank');
                win.focus();
                clear();
                $('#modalApprove').modal('hide');
                SuccessAlert('Berhasil!', 'Berhasil menyimpan data...');
                reload();
            });
        }

        function eventChangeAlasan(v) {
            let el = $('#panel-alasan');
            let elBerat = $('#panel-berat');
            if (v === '1') {
                $('#alasan').val('');
                el.removeClass('d-block');
                el.addClass('d-none');
                elBerat.removeClass('d-none');
                elBerat.addClass('d-block');
            } else {
                el.removeClass('d-none');
                el.addClass('d-block');
                elBerat.removeClass('d-block');
                elBerat.addClass('d-none');
            }
        }

        function clear() {
            $('#status').val('1');
            $('#name').val('');
            $('#paket').val('');
            $('#phone').val('');
            $('#harga').val('');
            eventChangeAlasan('1');
        }

        $(document).ready(function () {
            let url = '{{ route('admin.pesanan.menunggu') }}';
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

                {
                    data: null, render: function (data) {
                        let phone = data['user']['pelanggan']['no_hp'];
                        let name = data['user']['pelanggan']['nama'];
                        let paket = data['paket']['nama'];
                        let harga = data['harga'];
                        return '<a href="#" class="btn btn-sm btn-primary btn-approve" data-harga="' + harga + '" data-paket="' + paket + '" data-name="' + name + '" data-phone="' + phone + '" data-id="' + data['id'] + '"><i class="fa fa-spinner f12"></i></a>';
                    }
                },
            ], [
                {
                    targets: [0, 1, 2, 3, 6, 9],
                    className: 'text-center'
                },
                {
                    targets: [5, 7],
                    className: 'text-right'
                },
            ], function (d) {
            }, {
                "fnDrawCallback": function (setting) {
                    eventApprove();
                }
            });

            $('#modalApprove').on('shown.bs.modal', function () {
                let val = $('#status').val();
                eventChangeAlasan(val);
            });
            $('#status').on('change', function () {
                let val = this.value;
                eventChangeAlasan(val);
            });

            $('#btn-save').on('click', function () {
                approveHandler();
            })
        });

    </script>
@endsection
