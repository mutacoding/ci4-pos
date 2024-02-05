<?= $this->extend("layout/menu"); ?>

<?= $this->section("judul"); ?>
  Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="row">
  <!-- Start: Dashboard item 1 -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>jml</h3>
        <p>Produk</p>
      </div>
      <div class="icon">
        <i class="fa fa-boxes"></i>
      </div>
      <a href="<?= base_url() ?>penjualan/input" class="small-box-footer">Input Kasir <i class="fas fa-arrow-circle-right"></i></a>
    </div> 
  </div>
  <!-- End: Dashboard item 1 -->

  <!-- Start: Dashboard item 2 -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>jml</h3>
        <p>Kategori</p>
      </div>
      <div class="icon">
        <i class="fa fa-bars"></i>
      </div>
      <a href="<?= base_url() ?>penjualan/data" class="small-box-footer">Data Penjualan <i class="fas fa-arrow-circle-right"></i></a>
    </div> 
  </div>
  <!-- End: Dashboard item 2 -->

  <!-- Start: Dashboard item 3 -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>jml</h3>
        <p>Satuan</p>
      </div>
      <div class="icon">
        <i class="fa fa-tasks"></i>
      </div>
      <a href="<?= base_url() ?>penjualan/data" class="small-box-footer">Data Penjualan <i class="fas fa-arrow-circle-right"></i></a>
    </div> 
  </div>
  <!-- End: Dashboard item 3 -->

  <!-- Start: Dashboard item 4 -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>jml</h3>
        <p>User</p>
      </div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <a href="<?= base_url() ?>penjualan/data" class="small-box-footer">Data Penjualan <i class="fas fa-arrow-circle-right"></i></a>
    </div> 
  </div>
  <!-- End: Dashboard item 4 -->

  <!-- Start: Dashboard item 5 -->
  <div class="col-lg-4 col-1">
    <!-- info box -->
    <div class="info-box bg-purple">
      <span class="info-box-icon"><i class="fa fa-tag"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Income Hari Ini</span>
        <span class="info-box-number">Rp. 00000</span>
      </div>
    </div> 
  </div>
  <!-- End: Dashboard item 5 -->

  <!-- Start: Dashboard item 6 -->
  <div class="col-lg-4 col-1">
    <!-- info box -->
    <div class="info-box bg-pink">
      <span class="info-box-icon"><i class="fa fa-tag"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Income Bulan Ini</span>
        <span class="info-box-number">Rp. 00000</span>
      </div>
    </div> 
  </div>
  <!-- End: Dashboard item 6 -->

  <!-- Start: Dashboard item 7 -->
  <div class="col-lg-4 col-1">
    <!-- info box -->
    <div class="info-box bg-maroon">
      <span class="info-box-icon"><i class="fa fa-tag"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Income Tahun Ini</span>
        <span class="info-box-number">Rp. 00000</span>
      </div>
    </div> 
  </div>
  <!-- End: Dashboard item 7 -->
  

</div>
<?= $this->endSection(); ?>