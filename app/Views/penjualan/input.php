<?= $this->extend("layout/menu"); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section("judul"); ?>
  Menu Penjualan
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="card">
  <div class="card-header">
    <a href="<?= base_url() ?>penjualan/index" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</a>
  </div>
  <div class="card-body">
    <form action="">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label for="en_faktur">Faktur</label>
            <input type="text" class="form-control" id="en_faktur" name="en_faktur" readonly style="color: blue;font-weight: bold; text-align: right; font-size: 30px;">
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="en_tanggal">Tanggal</label>
            <input type="date" class="form-control" id="en_tanggal" name="en_tanggal" value="<?= date('Y-m-d') ?>" readonly>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="en_pelanggan">Pelanggan</label>
            <div class="input-group">
              <input type="text" class="form-control" id="en_pelanggan" name="en_pelanggan" value="-" readonly>
              <input type="hidden" class="form-control" id="en_kopel" name="en_kopel" value="0" readonly>
              <div class="input-group-append">
                <button type="button" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="en_faktur">Aksi</label>
            <div>
              <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="en_faktur">Kode Produk</label>
            <input type="text" class="form-control" id="en_faktur" name="en_faktur" autocomplete="off">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="en_faktur">Jumlah</label>
            <input type="text" class="form-control" id="en_faktur" name="en_faktur" value="1">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="en_faktur">Total Bayar</label>
            <input type="text" class="form-control" id="en_faktur" name="en_faktur" value="0" readonly style="color: blue;font-weight: bold; text-align: right; font-size: 30px;">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  function buatFaktur(){
    $.ajax({
      url: "<?= base_url() ?>penjualan/buatFaktur",
      type: "post",
      data: {
        tanggal : $("#en_tanggal").val(),
      },
      dataType: "json",
      success: function(respon){

      },
      error: function(xhr, thrownError){
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    })
  }
</script>
<?= $this->endSection(); ?>