<?= $this->extend("layout/menu"); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section("judul"); ?>
  Manajemen Data Produk
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="card">
  <div class="card-header">
    <button type="button" class="btn btn-primary" onclick="Tambah()"><i class="fas fa-plus"></i> Tambah Kategori
    </button>
  </div>
  <div class="card-body">
    <!-- Start: Tabel Kategori -->
    <table id="t_produk" class="table table-bordered table-striped w-100">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kode Barcode</th>
          <th scope="col">Nama Produk</th>
          <th scope="col">Kategori</th>
          <th scope="col">Satuan</th>
          <th scope="col">Harga Beli</th>
          <th scope="col">Harga Jual</th>
          <th scope="col">Stok Tersedia</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <!-- End: Tabel Kategori -->
  </div> 
</div>

<!-- Start: Modal Create -->
<div class="modal fade" id="m_create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Start: Tambah Data Produk -->
        <form id="c_produk" method="post" action="Javascript:Create();">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="en_kode">Kode Produk</label>
                <input type="text" class="form-control" id="en_kode" name="en_kode">
                <small class="text-danger e-kode"></small>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="en_produk">Nama Produk</label>
                <input type="text" class="form-control" id="en_produk" name="en_produk">
                <small class="text-danger e-produk"></small>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="en_kategori">Kategori</label>
                <div class="">
                  <select class="form-control" id="en_kategori" name="en_kategori">
                    <option>-Pilih-</option>
                    <?php foreach($kategori as $kat) : ?>
                      <option value="<?= $kat['id_kategori']; ?>"><?= $kat['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="en_satuan">Satuan</label>
                <div class="">
                  <select class="form-control" id="en_satuan" name="en_satuan">
                    <option>-Pilih-</option>
                    <?php foreach($satuan as $sat) : ?>
                      <option value="<?= $sat['id_satuan']; ?>"><?= $sat['nama_satuan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="en_stok">Stok Produk</label>
                <input type="text" class="form-control" id="en_stok" name="en_stok">
                <small class="text-danger e-stok"></small>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="en_beli">Harga Beli (Rp)</label>
                <div class="">
                  <input type="text" class="form-control" id="en_beli" name="en_beli" style="text-align: right;">
                  <small class="text-danger e-beli"></small>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="en_jual">Harga Jual (Rp)</label>
                <div class="">
                  <input type="text" class="form-control" id="en_jual" name="en_jual" style="text-align: right;">
                  <small class="text-danger e-jual"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" id="btn_create"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </form>
        <!-- End: Tambah Data Produk -->
      </div>
    </div>
  </div>
</div>
<!-- End: Modal create -->

<!-- Start: Modal update -->
<div class="modal fade" id="m_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="u_kategori" method="post" action="Javascript:Update();">
          <?= csrf_field() ?>
          <input type="hidden" name="en_id" id="en_id">
          <div class="form-group">
            <label for="en_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="en_kategori" name="en_kategori">
            <small class="text-danger e-kategori"></small>
          </div>
          <button type="submit" class="btn btn-primary" id="btn_update">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal update -->


<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  // Fetch Data
  $(document).ready(function() {
    var table = $('#t_produk').DataTable({
      "ajax": {
        "url": '<?= base_url(); ?>produk/getAllProduk',
        "type": "POST",
        "dataType": "json",
        async: "true"
      }
    });
  });

  // Tambah Data
  function Tambah() {
    $('#m_create').modal('show');
  }

  function Create(){
    $.ajax({
      url: "<?= base_url(); ?>produk/createProduk",
      type: "post",
      dataType: "json",
      data: $("#c_produk").serialize(),
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

  // Hapus Data
  function Delete(id){
    $.ajax({
      url: "<?= base_url() ?>produk/deleteProduk",
      type: "POST",
      data : { 
        id : id 
      },
      dataType: "json",
      success: function(respon){
        if(respon.status){
          Swal.fire({
            icon: "success",
            text: respon.msg,
          }).then(function() {
            $('#t_produk').DataTable().ajax.reload(null, false).draw(false);
          });
        }
      }
    })
  }
</script>
<?= $this->endSection(); ?>