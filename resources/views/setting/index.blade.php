@extends('layout.master')

@section('title')
    Setting
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pengaturan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <form role="form" action="{{ route('setting.update') }}" class="form-setting" method="POST"
                        data-toggle="validator" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <i class="ifon fa fa-check"></i>Perubahan berhasil disimpan
                            </div>
                            <div class="form-group">
                                <label for="nama_prusahaan" class="col-lg-12 control-label">Nama Perusahaan</label>
                                <input type="text" name="nama_prusahaan" id="nama_prusahaan" class="form-control" required
                                    autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="col-lg-12 control-label">Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-lg-12 control-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="path_logo" class="col-lg-12 control-label">Logo Peusahaan</label>
                                <input type="file" name="path_logo" id="path_logo" class="form-control"
                                    onchange="preview('.tampil-logo', this.files[0])">
                                <span class="help-block with-errors"></span>
                                <br>
                                <div class="tampil-logo"></div>
                            </div>
                            <div class="form-group">
                                <label for="path_kartu_member" class="col-lg-12 control-label">Desain Kartu
                                    Member</label>
                                <input type="file" name="path_kartu_member" id="path_kartu_member" class="form-control"
                                    onchange="preview('.tampil-kartu-member', this.files[0], 300)">
                                <span class="help-block with-errors"></span>
                                <br>
                                <div class="tampil-kartu-member"></div>
                            </div>
                            <div class="form-group">
                                <label for="diskon" class="col-lg-12 control-label">Diskon</label>
                                <input type="number" name="diskon" id="diskon" class="form-control" required>
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="tipe_nota" class="col-lg-12 control-label">Tipe Nota</label>
                                <select name="tipe_nota" id="tipe_nota" class="form-control">
                                    <option value="1">Nota Kecil</option>
                                    <option value="2">Nota Besar</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            showData();
            $('.form-setting').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('.form-setting').attr('action'),
                            type: $('.form-setting').attr('method'),
                            data: new FormData($('.form-setting')[0]),
                            async: false,
                            processData: false,
                            contentType: false
                        })
                        .done(response => {
                            showData();
                            $('.alert').fadeIn();
                            setTimeout(() => {
                                $('.alert').fadeOut();
                            }, 3000);
                        })
                        .fail(errors => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            });
        });

        function showData() {
            $.get('{{ route('setting.show') }}')
                .done(response => {
                    $('[name=nama_prusahaan]').val(response.nama_prusahaan);
                    $('[name=telepon]').val(response.telepon);
                    $('[name=alamat]').val(response.alamat);
                    $('[name=diskon]').val(response.diskon);
                    $('[name=tipe_nota]').val(response.tipe_nota);
                    $('title').text(response.nama_prusahaan + ' | Pengaturan');

                    $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="300">`);
                    $('.tampil-kartu-member').html(
                        `<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                    $('[rel=icon]').attr('href', `{{ url('/') }}/${response.path_logo}`)
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                })
        }
    </script>
@endpush
