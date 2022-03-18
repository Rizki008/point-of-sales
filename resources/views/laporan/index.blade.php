@extends('layout.master')

@section('title')
    Laporan Pendapatn {{ tanggal_indonesia($tanggalAwal) }} s/d {{ tanggal_indonesia($tanggalAkhir) }}
@endsection
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('/template/plugins/daterangepicker/daterangepicker.css') }}">
@endpush --}}
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button onclick="updatePeriode()" type="button" class="btn btn-primary btn-sm"><i
                                class="fa fa-plus"></i>
                            Ubah Periode</button>
                        <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"
                            class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Export PDF</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Penjualan</th>
                                    <th>Penjualan</th>
                                    <th>laporan</th>
                                    <th>Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    @includeIf('laporan.form')
@endsection

@push('scripts')
    {{-- <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'penjualan'
                    },
                    {
                        data: 'pembelian'
                    },
                    {
                        data: 'pengeluaran'
                    },
                    {
                        data: 'pendapatan'
                    }
                ],
                dom: 'Brt',
                bSort: false,
                bPaginate: false,
            });

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });

        function updatePeriode() {
            $('#modal-form').modal('show');
        }
    </script>
@endpush
