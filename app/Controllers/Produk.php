<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\SatuanModel;

class Produk extends BaseController
{
  protected $produk;
  protected $kategori;
  protected $satuan;
  protected $validation;

  public function __construct() 
  {
    $this->produk = new ProdukModel();
    $this->kategori = new KategoriModel();
    $this->satuan = new SatuanModel();
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    $data = [
      "title" => "Produk",
      "kategori"  => $this->kategori->findAll(),
      "satuan"  => $this->satuan->findAll()
    ];
    return view('produk/index', $data);
  }

  public function getAllProduk()
  {
    $data['data'] = array();
    $result = $this->produk->getData();
    $no = 1;
    foreach ($result as $key => $value) {
      $ops = '<tr>';
      $ops .= '<a class="btn btn-success text-white" href="produk/edit/'.$value['id_produk'].'"><i class="fa fa-pen"></i></a>';
      $ops .= '<a class="btn btn-danger text-white" onclick="Delete(' . $value['id_produk'] . ')"><i class="fa fa-trash"></i></a>';
      $ops .= '</tr>';
      $data['data'][$key] = array(
        $no,
        $value['kode_produk'],
        $value['nama_produk'],
        $value['nama_kategori'],
        $value['nama_satuan'],
        "Rp " . number_format($value['harga_beli'], 0, ",", "."),
        "Rp " . number_format($value['harga_jual'], 0, ",", "."),
        $value['stok_produk'],
        $ops
      );
      $no++;
    }
    return $this->response->setJSON($data);
  }

  public function createProduk()
  {
    $valid = $this->validate([
      'en_kode' => [
        'label' => 'Kode Produk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_produk' => [
        'label' => 'Nama Produk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_stok' => [
        'label' => 'Stok Produk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_beli' => [
        'label' => 'Harga Beli',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_jual' => [
        'label' => 'Harga Jual',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],
    ]);

    if (!$valid) {
      $msg = [
        'error' => [
          'en_kode' => $this->validation->getError('en_kode'),
          'en_produk' => $this->validation->getError('en_produk'),
          'en_stok' => $this->validation->getError('en_stok'),
          'en_beli' => $this->validation->getError('en_beli'),
          'en_jual' => $this->validation->getError('en_jual'),
        ]
      ];
      return $this->response->setJSON($msg);
    } else {
      $data = [
        'kode_produk' => $this->request->getPost('en_kode'),
        'nama_produk' => $this->request->getPost('en_produk'),
        'kategori_id' => $this->request->getPost('en_kategori'),
        'satuan_id' => $this->request->getPost('en_satuan'),
        'harga_beli' => str_replace('.', '', $this->request->getPost('en_beli')),
        'harga_jual' => str_replace('.', '', $this->request->getPost('en_jual')),
        'stok_produk' => $this->request->getPost('en_stok'),
      ];

      $status = $this->produk->insertData($data);

      if ($status) {
        $respon = [
          'status' => true,
          'msg' => 'Produk berhasil ditambah!'
        ];
      } else {
        $respon = [
          'status' => false,
          'msg' => 'Maaf, produk gagal ditambah!'
        ];
      }

      return $this->response->setJSON($respon);
    }
  }

  public function getOneProduk()
  {
    $id = $this->request->getPost('id');

    if ($this->validation->check($id, 'required|numeric')) {

      $data = $this->satuan->where('id_produk', $id)->first();

      return $this->response->setJSON($data);

    } else {

      throw new \CodeIgniter\Exceptions\PageNotFoundException();
      
    }
  }

  // Update Data
  public function updateProduk()
  {
    $id = $this->request->getPost("en_id");

    $valid = $this->validate([
      'en_kode' => [
        'label' => 'Kode Produk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_produk' => [
        'label' => 'Nama Produk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_stok' => [
        'label' => 'Stok Produk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_beli' => [
        'label' => 'Harga Beli',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'en_jual' => [
        'label' => 'Harga Jual',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],

      'new_cover' => [
        'label' => 'Cover Produk',
        'rules' => 'max_size[new_cover, 2048]|is_image[new_cover]',
        'errors' => [
          'required' => '{field} tidak boleh kosong!',
        ]
      ],
    ]);

    if (!$valid) {
      $msg = [
        'error' => [
          'en_kode' => $this->validation->getError('en_kode'),
          'en_produk' => $this->validation->getError('en_produk'),
          'en_stok' => $this->validation->getError('en_stok'),
          'en_beli' => $this->validation->getError('en_beli'),
          'en_jual' => $this->validation->getError('en_jual'),
        ]
      ];
      return $this->response->setJSON($msg);
    } else {

      // ambil gambar
      $cover = $this->request->getFile('new_cover');

      // jika gambar tidak dimasukkan
      if ($cover->getError() == 4) {
        $namacover = $this->request->getPost('en_cover');
      } else {
        // generate nama cover
        $namacover = $cover->getRandomName();
        // pindahkan file gambar
        $cover->move('gambar', $namacover);

        if ($this->request->getPost('en_cover') !== "default.jpg"){
          // hapus file document lama
          unlink('gambar/' . $this->request->getPost('en_cover'));
        }
      }

      $data = [
        'kode_produk' => $this->request->getPost('en_kode'),
        'nama_produk' => $this->request->getPost('en_produk'),
        'kategori_id' => $this->request->getPost('en_kategori'),
        'satuan_id' => $this->request->getPost('en_satuan'),
        'harga_beli' => str_replace('.', '', $this->request->getPost('en_beli')),
        'harga_jual' => str_replace('.', '', $this->request->getPost('en_jual')),
        'stok_produk' => $this->request->getPost('en_stok'),
      ];

      $status = $this->produk->updateData($id, $data);

      if ($status) {
        $respon = [
          'status' => true,
          'msg' => 'Produk berhasil diubah!'
        ];
      } else {
        $respon = [
          'status' => false,
          'msg' => 'Maaf, produk gagal diubah!'
        ];
      }

      return $this->response->setJSON($respon);
    }
  } 

  // Delete Data
  public function deleteProduk()
  {
    $id = $this->request->getPost("id");

    $result = $this->produk->deleteData($id);

    if($result){
      $respon = [
        "status" => true,
        "msg" => "Produk berhasil dihapus!"
      ];
    }else{
      $respon = [
        "status" => false,
        "msg" => "Produk gagal dihapus!"
      ];
    }

    return $this->response->setJSON($respon);
  }
}
