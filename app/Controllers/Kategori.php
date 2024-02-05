<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
  protected $kategori;
  protected $validation;

  public function __construct() 
  {
    $this->kategori = new KategoriModel();
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    $data = [
      "title" => "Kategori"
    ];
    return view('kategori/index', $data);
  }

  public function getAllKategori()
  {
    $data['data'] = array();
    $result = $this->kategori->select()->findAll();
    $no = 1;
    foreach ($result as $key => $value) {
      $ops = '<tr>';
      $ops .= '<a class="btn btn-success text-white" onclick="Edit(' . $value['id_kategori'] . ')"><i class="fa fa-pen"></i></a>';
      $ops .= '<a class="btn btn-danger text-white" onclick="Delete(' . $value['id_kategori'] . ')"><i class="fa fa-trash"></i></a>';
      $ops .= '</tr>';
      $data['data'][$key] = array(
        $no,
        $value['nama_kategori'],
        $ops
      );
      $no++;
    }
    return $this->response->setJSON($data);
  }

  public function createKategori()
  {
    $valid = $this->validate([
      'en_kategori' => [
        'label' => 'Nama Kategori',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],
    ]);

    if (!$valid) {
      $msg = [
        'error' => [
          'en_kategori' => $this->validation->getError('en_kategori'),
        ]
      ];

      return $this->response->setJSON($msg);

    } else {
      $data = [
        'nama_kategori' => $this->request->getPost('en_kategori'),
      ];

      $status = $this->kategori->insertData($data);

      if ($status) {
        $respon = [
          'status' => true,
          'msg' => 'Nama kategori berhasil ditambah!'
        ];
      } else {
        $respon = [
          'status' => false,
          'msg' => 'Maaf, nama kategori gagal ditambah!'
        ];
      }

      return $this->response->setJSON($respon);
    }
  }

  public function getOneKategori()
  {
    $id = $this->request->getPost('id');

    if ($this->validation->check($id, 'required|numeric')) {

      $data = $this->kategori->where('id_kategori', $id)->first();

      return $this->response->setJSON($data);

    } else {

      throw new \CodeIgniter\Exceptions\PageNotFoundException();
      
    }
  }

  // Update Data
  public function updateKategori()
  {
    $id_kat = $this->request->getPost("en_id");

    $valid = $this->validate([
      'en_kategori' => [
        'label' => 'Nama Kategori',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!!'
        ]
      ],
    ]);

    if (!$valid){
      $respon = [
        'error' => [
          'en_kategori' => $this->validation->getError('en_kategori'),
        ]
      ];
    }else{
      
      $data = [
        "nama_kategori" => $this->request->getPost("en_kategori")
      ];

      $result = $this->kategori->updateData($id_kat, $data);

      if($result){
        $respon = [
          "status" => true,
          "msg" => "Nama kategori berhasil diubah!"
        ];
      }else{
        $respon = [
          "status" => true,
          "msg" => "Maaf, Nama kategori gagal diubah!"
        ];
      }

      return $this->response->setJSON($respon);
    }
  } 

  // Delete Data
  public function deleteKategori()
  {
    $id = $this->request->getPost("id");

    $result = $this->kategori->deleteData($id);

    if($result){
      $respon = [
        "status" => true,
        "msg" => "Nama kategori berhasil dihapus!"
      ];
    }else{
      $respon = [
        "status" => false,
        "msg" => "Nama kategori gagal dihapus!"
      ];
    }

    return $this->response->setJSON($respon);
  }
}
