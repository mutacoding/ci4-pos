<?= $this->extend("layout/main"); ?>

<?= $this->section("menu") ?>
<li class="nav-item">
  <a href="<?= base_url() ?>" class="nav-link <?= $title == "Dashboard" ? "active" : "" ?>">
    <i class="nav-icon fa fa-tachometer-alt"></i>
    <p>
      Dashboard
    </p>
  </a>
</li>
<li class="nav-header">Master</li>
<li class="nav-item">
  <a href="<?= base_url() ?>kategori" class="nav-link <?= $title == "Kategori" ? "active" : "" ?>">
    <i class="nav-icon fa fa-bars"></i>
    <p>
      Kategori
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="<?= base_url() ?>satuan" class="nav-link <?= $title == "Satuan" ? "active" : "" ?>"">
  <i class="nav-icon fa fa-tasks"></i>
    <p>
      Satuan
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="<?= base_url() ?>produk" class="nav-link <?= $title == "Produk" ? "active" : "" ?>"">
    <i class="nav-icon fa fa-box"></i>
    <p>
      Produk
    </p>
  </a>
</li>
<li class="nav-header">Report</li>
<li class="nav-item">
  <a href="<?= base_url() ?>penjualan" class="nav-link">
    <i class="nav-icon fa fa-table"></i>
    <p>
      Laporan
    </p>
  </a>
</li>
<?= $this->endSection(); ?>