<div class="modal fade" id="modal-form" aria-labelledby="modal-form">
    <div class="modal-dialog">
        <form action="{{ route('laporan.index') }}" method="get" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Periode Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal</label>
                        <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control datepicker" required
                            autofocus value="{{ request('tanggal_awal ') }}" style="border-radius: 0 !important;">
                        <span class="help-block wirth-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="tanggl_akhir">Tanggal Akhir</label>
                        <input type="text" name="tanggl_akhir" id="tanggl_akhir" class="form-control datepicker"
                            required value="{{ request('tanggal_awal ') }}" style="border-radius: 0 !important;">
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
