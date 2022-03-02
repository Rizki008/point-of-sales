@extends('layout.master')

@section('title')
    Data Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Pembelian</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button onclick="addForm()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Transaksi
                            Baru</button>
                        @empty(!session('id_pembelian'))
                            <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-pencil-alt"></i>Transaksi Aktif</a>
                        @endempty
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-pembelian">
                            <thead>
                                <tr>
                                    <th width='5%'>No</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Diskon</th>
                                    <th>Total Bayar</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeIf('pembelian.supplier')
    @includeIf('pembelian.detail')
@endsection

@push('scripts')
    <script>
        let table, table1;
        $(function() {
            table = $('.table-pembelian').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'supplier'
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                    }
                ]
            });
            $('.table-supplier').DataTable();
            table1 = $('.table-detail').DataTable({
                processing: true,
                bsort: false,
                dom: 'Brt',
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    }
                ]
            })
        });

        function addForm() {
            $('#modal-supplier').modal('show');
        }

        function showDetail(url) {
            $('#modal-detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        function deleteData(url) {
            if (confirm('Apakah Yakin Akan Menghapus Data?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak Dapat Menghapus Data')
                        return;
                    })
            }
        }
    </script>
@endpush
