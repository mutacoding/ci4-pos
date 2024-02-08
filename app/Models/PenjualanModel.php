<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
  protected $table      = 'tbl_penjualan';
  protected $primaryKey = 'id_penjualan';
  protected $allowedFields = [
    "no_faktur","tgl_jual","jam_jual","total_harga","total_bayar",'kembalian'
  ];

  public function NoFaktur()
  {
    $tgl = date("Y-m-d");
    $query = $this->db->query("SELECT MAX(RIGHT(no_faktur, 4)) AS no_urut FROM tbl_penjualan WHERE DATE(tgl_jual)='$tgl' ");
    $hasil = $query->getRowArray();

    if ($hasil['no_urut'] > 0){
      $tmp = $hasil['no_urut'] + 1;
      $kd = sprintf("%04s", $tmp);
    }else{
      $kd = "0001";
    }
    $no_faktur = date("Ymd").$kd;
    return $no_faktur;
  }

  public function CekProduk($kode)
  {
    return $this->db->table('tbl_produk')
      ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id')
      ->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id')
      ->where('kode_produk', $kode)
      ->get()
      ->getRowArray();
  }

  public function InsertData($data){
    return $this->db->table("tbl_penjualan")->insert($data);
  }
}
