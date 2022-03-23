@extends('layout.master')

@section('title')
    Edit Profil
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profil</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <form role="form" action="{{ route('user.update_profil') }}" class="form-profil" method="POST"
                        data-toggle="validator" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <i class="ifon fa fa-check"></i>Perubahan berhasil disimpan
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-lg-12 control-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" required autofocus
                                    value="{{ $profil->name }}">
                                <span class="help-block with-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="col-lg-12 control-label">Profil</label>
                                <input type="file" name="foto" id="foto" class="form-control"
                                    onchange="preview('.tampil-foto', this.files[0])">
                                <span class="help-block with-errors"></span>
                                <br>
                                <div class="tampil-foto"><img src="{{ url($profil->foto ?? '/') }}" width="300"></div>
                            </div>
                            <div class="form-group">
                                <label for="old_password">Password Lama</label>
                                <input type="password" name="old_password" id="old_password" class="form-control"
                                    minlength="8">
                                <span class="help-block wirth-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" minlength="8">
                                <span class="help-block wirth-errors"></span>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" data-match="#password">
                                <span class="help-block wirth-errors"></span>
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
            $('#old_password').on('keyup', function() {
                if ($(this).val() != "")
                    $('#password, #password_confirmation').attr('required', true);
                else $('#password, #password_confirmation').attr('required', false);
            });
            $('.form-profil').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('.form-profil').attr('action'),
                            type: $('.form-profil').attr('method'),
                            data: new FormData($('.form-profil')[0]),
                            async: false,
                            processData: false,
                            contentType: false
                        })
                        .done(response => {
                            $('[name=name]').val(response.name);

                            $('.tampil-foto').html(
                                `<img src="{{ url('/') }}${response.foto}" width="300">`);
                            $('.img-profil').attr('src', `{{ url('/') }}/${response.foto}`);
                            $('.alert').fadeIn();
                            setTimeout(() => {
                                $('.alert').fadeOut();
                            }, 3000);
                        })
                        .fail(errors => {
                            if (errors.status = 422) {
                                alert(errors.responseJSON);
                            } else {
                                alert('Tidak dapat menyimpan data');
                            }
                            return;
                        });
                }
            });
        });
    </script>
@endpush
