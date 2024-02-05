<?= $this->extend("layout/menu"); ?>

<?= $this->section("judul"); ?>
  Manajemen Data Kategori
<?= $this->endSection(); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="card">
  <div class="card-header">
    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="Tambah()"><i class="fas fa-plus"></i> Tambah Kategori
    </button>
  </div>
  <div class="card-body">
    <!-- Start: Tabel Kategori -->
    <table id="t_kategori" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kategori</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <!-- End: Tabel Kategori -->
  </div> 
</div>

<!-- Start: Modal create -->
<div class="modal fade" id="m_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="c_kategori" method="post" action="Javascript:Create();">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="en_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="en_kategori" name="en_kategori">
            <small class="text-danger e-kategori"></small>
          </div>
          <button type="submit" class="btn btn-primary" id="btn_create">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal create -->

<!-- Start: Modal update -->
<div class="modal fade" id="m_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
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
    var table = $('#t_kategori').DataTable({
      "ajax": {
        "url": '<?= base_url(); ?>kategori/getAllKategori',
        "type": "POST",
        "dataType": "json",
        async: "true"
      }
    });
  });

  // Tambah Data
  function Tambah() {
    $('#m_kategori').modal('show');
  }

  function Create(){
    $.ajax({
      url: "<?= base_url(); ?>kategori/createKategori",
      type: "post",
      dataType: "json",
      data: $("#c_kategori").serialize(),
      success: function (respon){
        if (respon.error) {
          if (respon.error.en_kategori) {
            $('#en_kategori').addClass('is-invalid');
            $('.e-kategori').html(respon.error.en_kategori);
          } else {
            $('#en_kategori').removeClass('is-invalid');
            $('.e-kategori').html('');
          }
        } else {
          if (respon.status) {
            $('#m_kategori').modal('hide');
            Swal.fire({
              icon: 'success',
              text: respon.msg,
            }).then(function() {
              $('#t_kategori').DataTable().ajax.reload(null, false).draw(false);
              $('#c_kategori')[0].reset();
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
      url: "<?= base_url() ?>kategori/deleteKategori",
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
            $('#t_kategori').DataTable().ajax.reload(null, false).draw(false);
          });
        }
      }
    })
  }

  // Edit Data
  function Edit(id){
    $.ajax({
      url: "<?= base_url() ?>kategori/getOneKategori",
      type: "POST",
      data : {
        id : id
      },
      success: function(respon){
        $("#m_edit").modal("show");

        // insert data to form
        $("#u_kategori #en_id").val(respon.id_kategori);
        $("#u_kategori #en_kategori").val(respon.nama_kategori);
      }
    });
  }

  function Update(){
    $.ajax({
      url: "<?= base_url(); ?>kategori/updateKategori",
      type: "post",
      dataType: "json",
      data: $("#u_kategori").serialize(),
      success: function (respon){
        if (respon.error) {
          if (respon.error.en_kategori) {
            $('#en_kategori').addClass('is-invalid');
            $('.e-kategori').html(respon.error.en_kategori);
          } else {
            $('#en_kategori').removeClass('is-invalid');
            $('.e-kategori').html('');
          }
        } else {
          if (respon.status) {
            $('#m_edit').modal('hide');
            Swal.fire({
              icon: 'success',
              text: respon.msg,
            }).then(function() {
              $('#t_kategori').DataTable().ajax.reload(null, false).draw(false);
              $('#u_kategori')[0].reset();
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