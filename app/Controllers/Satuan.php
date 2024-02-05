<?php

namespace App\Controllers;

use App\Models\SatuanModel;

class Satuan extends BaseController
{
  protected $satuan;
  protected $validation;

  public function __construct() 
  {
    $this->satuan = new SatuanModel();
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    $data = [
      "title" => "Satuan"
    ];
    return view('satuan/index', $data);
  }

  public function getAllSatuan()
  {
    $data['data'] = array();
    $result = $this->satuan->select()->findAll();
    $no = 1;
    foreach ($result as $key => $value) {
      $ops = '<tr>';
      $ops .= '<a class="btn btn-success text-white" onclick="Edit(' . $value['id_satuan'] . ')"><i class="fa fa-pen"></i></a>';
      $ops .= '<a class="btn btn-danger text-white" onclick="Delete(' . $value['id_satuan'] . ')"><i class="fa fa-trash"></i></a>';
      $ops .= '</tr>';
      $data['data'][$key] = array(
        $no,
        $value['nama_satuan'],
        $ops
      );
      $no++;
    }
    return $this->response->setJSON($data);
  }

  public function createSatuan()
  {
    $valid = $this->validate([
      'en_satuan' => [
        'label' => 'Nama Satuan',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],
    ]);

    if (!$valid) {
      $msg = [
        'error' => [
          'en_satuan' => $this->validation->getError('en_satuan'),
        ]
      ];

      return $this->response->setJSON($msg);

    } else {
      $simpandata = [
        'nama_satuan' => $this->request->getPost('en_satuan'),
      ];

      $status = $this->satuan->insertData($simpandata);

      if ($status) {
        $respon = [
          'status' => true,
          'msg' => 'Nama satuan berhasil ditambah!!'
        ];
      } else {
        $respon = [
          'status' => false,
          'msg' => 'Maaf, nama satuan gagal ditambah!!'
        ];
      }

      return $this->response->setJSON($respon);
    }
  }

  public function getOneSatuan()
  {
    $id = $this->request->getPost('id');

    if ($this->validation->check($id, 'required|numeric')) {

      $data = $this->satuan->where('id_satuan', $id)->first();

      return $this->response->setJSON($data);

    } else {

      throw new \CodeIgniter\Exceptions\PageNotFoundException();
      
    }
  }

  // Update Data
  public function updateSatuan()
  {
    $id = $this->request->getPost("en_id");

    $valid = $this->validate([
      'en_satuan' => [
        'label' => 'Nama Satuan',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!!'
        ]
      ],
    ]);

    if (!$valid){
      $respon = [
        'error' => [
          'en_satuan' => $this->validation->getError('en_satuan'),
        ]
      ];
    }else{
      
      $data = [
        "nama_satuan" => $this->request->getPost("en_satuan")
      ];

      $result = $this->satuan->updateData($id, $data);

      if($result){
        $respon = [
          "status" => true,
          "msg" => "Nama Satuan berhasil diubah!"
        ];
      }else{
        $respon = [
          "status" => true,
          "msg" => "Maaf, nama satuan gagal diubah!"
        ];
      }

      return $this->response->setJSON($respon);
    }
  } 

  // Delete Data
  public function deleteSatuan()
  {
    $id = $this->request->getPost("id");

    $result = $this->satuan->deleteData($id);

    if($result){
      $respon = [
        "status" => true,
        "msg" => "Nama satuan berhasil dihapus!"
      ];
    }else{
      $respon = [
        "status" => false,
        "msg" => "Nama satuan gagal dihapus!"
      ];
    }

    return $this->response->setJSON($respon);
  }
}
