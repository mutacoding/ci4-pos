<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
  protected $table      = 'tbl_kategori';
  protected $primaryKey = 'id_kategori';
  protected $allowedFields = [
    'nama_kategori'
  ];

  public function insertData($data)
  {
    return $this->db->table("tbl_kategori")->insert($data);
  }

  public function deleteData($id)
  {
    return $this->delete(["id_kategori" => $id]);
  }

  public function updateData($id, $data)
  {
    return $this->update(["id_kategori" => $id], $data);
  }
}
