<?= $this->extend("layout/menu"); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section("judul"); ?>
  Tambah Data Produk
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="card">
  <div class="card-header">
    <a href="<?= base_url() ?>produk" class="btn btn-primary">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
  <div class="card-body">
    <!-- Start: Tambah Data Produk -->
    <form id="c_produk" method="post" action="Javascript:Create();">
      <?= csrf_field() ?>
      <div class="form-group row">
        <label for="en_kode" class="col-sm-4 col-form-label">Kode Produk</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="en_kode" name="en_kode">
          <small class="text-danger e-kode"></small>
        </div>
      </div>
      <div class="form-group row">
        <label for="en_produk" class="col-sm-4 col-form-label">Nama Produk</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="en_produk" name="en_produk">
          <small class="text-danger e-produk"></small>
        </div>
      </div>
      <div class="form-group row">
        <label for="en_stok" class="col-sm-4 col-form-label">Stok Produk</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="en_stok" name="en_stok">
          <small class="text-danger e-stok"></small>
        </div>
      </div>
      <div class="form-group row">
        <label for="en_kategori" class="col-sm-4 col-form-label">Kategori</label>
        <div class="col-sm-4">
          <select class="form-control" id="en_kategori" name="en_kategori">
            <option>-Pilih-</option>
            <?php foreach($kategori as $kat) : ?>
              <option value="<?= $kat['katid']; ?>"><?= $kat['katnama']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="en_satuan" class="col-sm-4 col-form-label">Satuan</label>
        <div class="col-sm-4">
          <select class="form-control" id="en_satuan" name="en_satuan">
            <option>-Pilih-</option>
            <?php foreach($satuan as $sat) : ?>
              <option value="<?= $sat['satid']; ?>"><?= $sat['satnama']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="en_beli" class="col-sm-4 col-form-label">Harga Beli (Rp)</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="en_beli" name="en_beli" style="text-align: right;">
          <small class="text-danger e-beli"></small>
        </div>
      </div>
      <div class="form-group row">
        <label for="en_jual" class="col-sm-4 col-form-label">Harga Jual (Rp)</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="en_jual" name="en_jual" style="text-align: right;">
          <small class="text-danger e-jual"></small>
        </div>
      </div>
      <div class="form-group row">
        <label for="en_cover" class="col-sm-4 col-form-label">Upload Cover (<i>Jika ada</i>)</label>
        <div class="col-sm-4">
          <input type="file" class="form-control" id="en_cover" name="en_cover">
          <small class="text-danger e-cover"></small>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success" id="btn_create"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </form>
    <!-- End: Tambah Data Produk -->
  </div> 
</div>
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#en_beli').autoNumeric('init', {
      aSep: '.',
      aDec: ',',
      mDec: '2'
    });

    $('#en_jual').autoNumeric('init', {
      aSep: '.',
      aDec: ',',
      mDec: '2'
    });
  });

  function Create(){
    let form = $("#c_produk");
    let formData = new FormData(form[0]);
    $.ajax({
      url: "<?= base_url(); ?>produk/createProduk",
      type: "post",
      dataType: "json",
      data: formData,
      enctype: 'multipart/form-data',
      cache: false,
      contentType: false, // Let jQuery handle content type
      processData: false, // Don't process data, let jQuery handle it
      success: function (respon){
        if (respon.error) {
          if (respon.error.en_kode) {
            $('#en_kode').addClass('is-invalid');
            $('.e-kode').html(respon.error.en_kode);
          } else {
            $('#en_kode').removeClass('is-invalid');
            $('.e-kode').html('');
          }

          if (respon.error.en_produk) {
            $('#en_produk').addClass('is-invalid');
            $('.e-produk').html(respon.error.en_produk);
          } else {
            $('#en_produk').removeClass('is-invalid');
            $('.e-produk').html('');
          }

          if (respon.error.en_stok) {
            $('#en_stok').addClass('is-invalid');
            $('.e-stok').html(respon.error.en_stok);
          } else {
            $('#en_stok').removeClass('is-invalid');
            $('.e-stok').html('');
          }

          if (respon.error.en_beli) {
            $('#en_beli').addClass('is-invalid');
            $('.e-beli').html(respon.error.en_beli);
          } else {
            $('#en_beli').removeClass('is-invalid');
            $('.e-beli').html('');
          }

          if (respon.error.en_jual) {
            $('#en_jual').addClass('is-invalid');
            $('.e-jual').html(respon.error.en_jual);
          } else {
            $('#en_jual').removeClass('is-invalid');
            $('.e-jual').html('');
          }

          if (respon.error.en_cover) {
            $('#en_cover').addClass('is-invalid');
            $('.e-cover').html(respon.error.en_cover);
          } else {
            $('#en_cover').removeClass('is-invalid');
            $('.e-cover').html('');
          }
        } else {
          if (respon.status) {
            Swal.fire({
              icon: 'success',
              text: respon.msg,
            }).then(function() {
              $('#c_produk')[0].reset();
            })
          } else {
            Swal.fire({
              icon: 'warning',
              text: respon.msg,
            });
          }
        } 
      }
    })
  }
</script>
<?= $this->endSection(); ?>