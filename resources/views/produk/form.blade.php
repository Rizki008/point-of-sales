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
                        <label for="nama_produk">Nama produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" required autofocus>
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama_kategori">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="merek">Merek</label>
                        <input type="text" name="merek" id="merek" class="form-control">
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" name="stock" id="stock" class="form-control" required value="0">
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
