@extends('layout.master')

@section('title')
    Data Member
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Member</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button onclick="addForm('{{ route('member.store') }}')" type="button"
                            class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                            Add</button>
                        <button onclick="cetakMember('{{ route('member.cetak_member') }}')"
                            class="btn btn-success btn-sm"><i class="fa fa-id-card"></i>
                            Cetak Member</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <form action="" method="POST" class="form-member">
                            @csrf
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">
                                            <input type="checkbox" name="select_all" id="select_all">
                                        </th>
                                        <th width="5%">No</th>
                                        <th>Kode Member</th>
                                        <th>Nama Member</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th width="15%"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                            </table>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    @includeIf('member.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('member.data') }}',
                },
                columns: [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_member'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'telepon'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    }
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('#modal-form form').attr('action'),
                            type: 'post',
                            data: $('#modal-form form').serialize()
                        })
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak Dapat Menambahkan Data');
                            return;
                        });
                }
            });

            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Kategori');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Kategori');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=telepon]').val(response.telepon);
                    $('#modal-form [name=alamat]').val(response.alamat);
                })
                .fail((errors) => {
                    alert('Tidak Dapat Menampilkan Data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Apakah Yakin Akan Menghapus Data??')) {
                $.post(url, {
                        // '_token': '{{ csrf_token() }}'
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak Dapat Menghapus Data');
                        return;
                    });
            }
        }

        function cetakMember(url) {
            if ($('input:checked').length < 1) {
                alart('Pilih Data Yang Akan Dicetak');
                return;
            } else {
                $('.form-member')
                    .attr('target', '_blank')
                    .attr('action', url)
                    .submit();
            }
        }
    </script>
@endpush
