<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
  protected $table      = 'tbl_detail_penjualan';
  protected $primaryKey = 'id_detail_penjualan';
  protected $allowedFields = [
    "no_faktur", "kode_produk", "nama_produk", "qty", "harga_jual", "total_harga"
  ];

  public function insertData($data)
  {
    return $this->db->table("tbl_detail_penjualan")->insert($data);
  }

  public function deleteData($id)
  {
    return $this->delete(["id_detail_penjualan" => $id]);
  }

  public function totalBelanja($faktur)
  {
    return $this->select("SUM(total_harga) as total_bayar")->where("no_faktur", $faktur)->get()->getRowArray();
  }

  public function FakturBelanja($no_faktur)
  {
    return $this->db->table("tbl_detail_penjualan")
      ->where("no_faktur", $no_faktur)
      ->get()
      ->getResultArray();
  }
}
