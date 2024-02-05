<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
  protected $table      = 'tbl_produk';
  protected $primaryKey = 'id_produk';
  protected $allowedFields = [
    'kode_produk', 'nama_produk', 'kategori_id', 'satuan_id', 'harga_beli', 'harga_jual', 'stok_produk',
  ];

  public function getData()
  {
    $getData = $this->db->table('tbl_produk')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id')->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
    $query = $getData->get();
    return $query->getResultArray();
  }

  public function insertData($data)
  {
    return $this->db->table("tbl_produk")->insert($data);
  }

  public function deleteData($id)
  {
    return $this->delete(["id_produk" => $id]);
  }

  public function updateData($id, $data)
  {
    return $this->update(["id_produk" => $id], $data);
  }
}
