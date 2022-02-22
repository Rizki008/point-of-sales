<div class="modal fade" id="modal-form" aria-labelledby="modal-form">
    <div class="modal-dialog">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="telepon">telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" required>
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="alamat">alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                        <span class="help-block wirth-errors"></span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
