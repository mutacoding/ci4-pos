<?= $this->extend("layout/kasir"); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section("judul"); ?>
  Kasir
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="row">
  <div class="col-lg-7">
    <div class="card card-primary card-outline">
      <div class="card-body p-2">
        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label>No Faktur</label>
              <input type="text" class="form-control text-danger" id="en_faktur" readonly value="<?= $faktur; ?>">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="en_faktur">Tanggal</label>
              <input type="date" class="form-control" id="en_tgl" value="<?= date("Y-m-d"); ?>" readonly>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="en_faktur">Jam</label>
              <input class="form-control" id="en_tgl" value="<?= date("H:i:s"); ?>" readonly>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="en_faktur">Kasir</label>
              <input class="form-control" id="en_tgl" value="<?= "Nama Kasir" ?>" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5 col-6">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="m-0"></h5>
      </div>
      <div class="card-body bg-black">
        <h4 class="display-5 text-right text-green" id="total_belanja"></h4>
      </div>
    </div>
  </div>

  <!-- Start: Cart section -->
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <!-- Start : Form Cart -->
        <form id="c_jual" method="post" action="Javascript:TambahBelanja()">
          <div class="row">
            <div class="col-lg-3">
              <input type="hidden" id="en_faktur" name="en_faktur" value="<?= $faktur; ?>">
              <div class="form-group input-group">
                <input type="text" class="form-control" id="en_kode" name="en_kode" placeholder="Kode Produk">
                <span class="input-group-append">
                  <button type="button" class="btn btn-primary btn-flat" id="cari_produk">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <input type="text" class="form-control" id="en_nama_produk" name="en_nama_produk" readonly placeholder="Nama Produk">
              </div>
            </div>
            <div class="col-lg-1">
              <div class="form-group">
                <input type="number" class="form-control" id="en_qty" name="en_qty" min="1" value="1" placeholder="Qty">
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group">
                <input type="text" class="form-control text-rigth" id="en_harga_jual" name="en_harga_jual" readonly placeholder="Harga">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Tambah</button>
                <button type="reset" class="btn btn-warning"><i class="fa fa-sync"></i> Reset</button>
                <button type="button" class="btn btn-success" id="btn_pembayaran"><i class="fa fa-cash-register"></i> Pembayaran</button>
              </div>
            </div>
          </div>
        </form>
        <!-- End : Form Cart -->
        <div class="row">
          <!-- Start : Table Cart -->
          <div class="col-lg-12">
            <table class="table table-bordered table-stripped">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Kode Produk</th>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">QTY</th>
                  <th scope="col">Harga Produk</th>
                  <th scope="col">Total Harga</th>
                  <th scope="col">#</th>
                </tr>
              </thead>
              <tbody id="t_keranjang"></tbody>
            </table>
          </div>
          <!-- End : Table Cart -->
        </div>
      </div>
    </div>
  </div>
  <!-- End: Cart Section -->
</div>

<!-- Start: Modal Product -->
<div class="modal fade" id="m_produk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tabel Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="t_produk" class="table w-100">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode Produk</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Harga Produk</th>
              <th scope="col">#</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal Product -->

<!-- Start: Modal Pembayaran -->
<div class="modal fade" id="m_pembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="c_pembayaran" method="post" action="Javascript:Pembayaran();">
          <div class="form-group">
            <label for="en_total_bayar">Total Belanja</label>
            <input type="text" class="form-control text-right" id="en_total_belanja" name="en_total_belanja" readonly>
          </div>
          <div class="form-group">
            <label for="en_total_bayar">Total Bayar</label>
            <input type="text" class="form-control text-right" id="en_total_bayar" name="en_total_bayar">
          </div>
          <div class="form-group">
            <label for="en_sisa_uang">Sisa Uang</label>
            <input type="text" class="form-control text-right" id="en_sisa_uang" name="en_sisa_uang" readonly autocomplete="off">
          </div>
          <button type="submit" class="btn btn-success float-right"><i class="fa fa-cash-register"></i> Pembayaran</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal Pembayaran -->
<?= $this->endSection(); ?>

<?= $this->section("script"); ?>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#t_produk').DataTable({
      "ajax": {
        "url": '<?= base_url(); ?>penjualan/viewProduk',
        "type": "post",
        "dataType": "json",
        async: "true"
      }
    });

    $("#en_kode").keydown(function(e){
      if (e.keyCode == 13){
        e.preventDefault();
        cekKode();
      }
    });

    $('#en_total_belanja').autoNumeric('init', {
      aSep: '.',
      aDec: ',',
      mDec: '2'
    });

    $('#en_total_bayar').autoNumeric('init', {
      aSep: '.',
      aDec: ',',
      mDec: '2'
    });

    $('#en_sisa_uang').autoNumeric('init', {
      aSep: '.',
      aDec: ',',
      mDec: '2'
    });

    ViewBelanja();
    TotalBelanja();
    
    $("#en_total_bayar").keyup(function(){
      kembalian();
    });

  });

  function cekKode(){
    let cek_kode = $("#en_kode").val();
    if (cek_kode.length == 0){
      alert("kosong");
    }else{
      cekProduk(cek_kode);
    }
  }

  function cekProduk(kode){
    $.ajax({
      url: "<?= base_url() ?>penjualan/CekProduk",
      method: "post",
      dataType: "json",
      data: {
        kode : kode
      },
      success: function(respon){
        if(respon.nama_produk == ""){
          Swal.fire({
            icon: 'warning',
            text: 'Maaf kode produk tidak tersedia!',
          }).then(function() {
            $('#c_jual')[0].reset();
          })
        }else{
          $("#m_produk").modal("hide");
          $("#c_jual #en_kode").val(respon.kode);
          $("#c_jual #en_nama_produk").val(respon.nama);
          $("#c_jual #en_harga_jual").val(respon.harga);
          $("#c_jual #en_qty").focus();
        }
      }
    })
  }

  $("#cari_produk").click(function(){
    $("#m_produk").modal("show");
  })

  function TambahBelanja(){
    $.ajax({
      url: "<?= base_url(); ?>penjualan/createPenjualan",
      type: "post",
      dataType: "json",
      data: $("#c_jual").serialize(),
      success: function(respon){
        $("#c_jual")[0].reset();
        ViewBelanja();
        TotalBelanja();
      }
    })
  }

  function ViewBelanja(){
    $.ajax({
      url: "<?= base_url(); ?>penjualan/TampilPenjualan",
      type: "post",
      dataType: "json",
      success: function(respon){
        $("#t_keranjang").html(respon.data);
      }
    })
  }

  function HapusItem(id){
    $.ajax({
      url: "<?= base_url(); ?>penjualan/HapusPenjualan",
      type: "post",
      dataType: "json",
      data: {
        id : id
      },
      success: function(respon){
        ViewBelanja();
        TotalBelanja();
      }
    })
  }

  function TotalBelanja(){
    $.ajax({
      url: "<?= base_url(); ?>penjualan/TotalPenjualan",
      type: "post",
      dataType: "json",
      data: {
        no_faktur : $("#en_faktur").val()
      },
      success: function(respon){
        $("#total_belanja").html(respon.total);
        $("#c_pembayaran #en_total_belanja").val(respon.total);
      }
    })
  }

  $("#btn_pembayaran").click(function(){
    $("#m_pembayaran").modal("show");
  });

  function kembalian()
  {
    let totalbelanja = $("#c_pembayaran #en_total_belanja").autoNumeric('get');
    let totalbayar = ($("#c_pembayaran #en_total_bayar").val() == '') ? 0 : $("#c_pembayaran #en_total_bayar").autoNumeric('get');

    let sisaUang = parseFloat(totalbayar) - parseFloat(totalbelanja);
    $("#c_pembayaran #en_sisa_uang").val(sisaUang);

    let sisaUangX = $("#c_pembayaran #en_sisa_uang").val();
    $("#c_pembayaran #en_sisa_uang").autoNumeric('set' ,sisaUangX);
  }

  function Pembayaran()
  {
    let jmluang = ($("#c_pembayaran #en_total_bayar").val() == '') ? 0 : $("#c_pembayaran #en_total_bayar").autoNumeric('get');
    let sisauang = ($("#c_pembayaran #en_sisa_uang").val() == '') ? 0 : $("#c_pembayaran #en_sisa_uang").autoNumeric('get');

    if (parseFloat(jmluang) == 0 || parseFloat(jmluang) == ''){
      Swal.fire({
        icon: 'warning',
        text: 'Maaf jumlah uang dibayar belum diisi!',
      });
    }else if(parseFloat(sisauang) < 0){
      Swal.fire({
        icon: 'warning',
        text: 'Maaf jumlah uang belum mencukupi!',
      });
    }else{
      $.ajax({
      url: "<?= base_url(); ?>penjualan/createPenjualan",
      type: "post",
      dataType: "json",
      data: $("#c_pembayaran").serialize(),
      success: function(respon){
        
      }
    })
    }
  }
</script>
<?= $this->endSection(); ?>