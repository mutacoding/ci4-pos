<?php

namespace App\Models;
use CodeIgniter\Model;

Class SatuanModel extends Model
{
  protected $table      = 'tbl_satuan';
  protected $primaryKey = 'id_satuan';
  protected $allowedFields = [
    'nama_satuan'
  ];

  public function insertData($data)
  {
    return $this->db->table("tbl_satuan")->insert($data);
  }

  public function deleteData($id)
  {
    return $this->delete(["id_satuan" => $id]);
  }

  public function updateData($id, $data)
  {
    return $this->update(["id_satuan" => $id], $data);
  }
}

?>