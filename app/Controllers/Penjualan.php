<?php

namespace App\Controllers;

use App\Models\DetailModel;
use App\Models\PenjualanModel;
use App\Models\ProdukModel;

class Penjualan extends BaseController
{
  protected $penjualan;
  protected $detail;
  protected $produk;
  protected $validation;

  public function __construct() 
  {
    $this->penjualan = new PenjualanModel();
    $this->produk = new ProdukModel();
    $this->detail = new DetailModel();
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    $data = [
      "title" => "Penjualan",
      "faktur" => $this->penjualan->NoFaktur()
    ];
    return view('penjualan/index', $data);
  }

  public function CekProduk()
  {
    $kode = $this->request->getPost("kode");

    $produk = $this->penjualan->CekProduk($kode);

    if ($produk != null){
      $data = [
        "kode" => $produk['kode_produk'],
        "nama" => $produk['nama_produk'],
        "harga" => $produk['harga_jual'],
      ];
    }else{
      $data = [
        "kode" => "",
        "nama" => "",
        "harga" => "",
      ];
    }

    return $this->response->setJSON($data);
  }

  public function viewProduk()
  {
    $data['data'] = array();
    $result = $this->produk->getData();
    $no = 1;
    foreach ($result as $key => $value) {
      $ops = '<tr>';
      $ops .= '<a class="btn btn-success text-white" onclick="cekProduk(' . $value['kode_produk'] . ')"><i class="fa fa-check"></i></a>';
      $ops .= '</tr>';
      $data['data'][$key] = array(
        $no,
        $value['kode_produk'],
        $value['nama_produk'],
        "Rp " . number_format($value['harga_jual'], 0, ",", "."),
        $ops
      );
      $no++;
    }
    return $this->response->setJSON($data);
  }

  public function createPenjualan()
  {
    $data = [
      'no_faktur' => $this->request->getPost('en_faktur'),
      'kode_produk' => $this->request->getPost('en_kode'),
      'nama_produk' => $this->request->getPost('en_nama_produk'),
      'qty' => $this->request->getPost('en_qty'),
      'harga_jual' => $this->request->getPost('en_harga_jual'),
      'total_harga' => $this->request->getPost('en_qty') * $this->request->getPost('en_harga_jual'),
    ];
    $result = $this->detail->insertData($data);

    return $this->response->setJSON($result);
  }

  public function TampilPenjualan()
  {
    $no_faktur = $this->request->getPost("faktur");
    $detail_produk = $this->detail->FakturBelanja($no_faktur);
    
    $data = "";
    $no = 1;
    if ($detail_produk){
      foreach ($detail_produk as $d) {
        $data .= '
                  <tr>
                    <th scope="row">'.$no.'</th>
                    <td>'.$d["kode_produk"].'</td>
                    <td>'.$d["nama_produk"].'</td>
                    <td>'.$d["qty"].'</td>
                    <td>Rp '.number_format($d['harga_jual'], 0, ",", ".").'</td> 
                    <td>Rp '.number_format($d['total_harga'], 0, ",", ".").'</td>
                    <td>
                      <button class="btn btn-danger" onclick="HapusItem('.$d["id_detail_penjualan"].')"><i class="fa fa-times"></i></button>
                    </td>
                  </tr>
                ';
        $no++;
      }

      return $this->response->setJSON([
        "status" => true,
        "data" => $data
      ]);

    }else{
      $data .= '
        <tr>
          <th colspan="6" class="text-center">Keranjang kosong silahkan isi</th>
        </tr>
      ';

      return $this->response->setJSON([
        "status" => true,
        "data" => $data
      ]);
    }
  }

  public function TotalPenjualan(){
    $nofaktur = $this->request->getPost("no_faktur");
    $hasil = $this->detail->totalBelanja($nofaktur);

    $respon = [
      "total" => number_format($hasil["total_bayar"], 0, ",", "."),
    ];

    return $this->response->setJSON($respon);
  }

  // Delete Data
  public function HapusPenjualan()
  {
    $id = $this->request->getPost("id");

    $result = $this->detail->deleteData($id);

    return $this->response->setJSON($result);
  }

  public function createPembayaran(){
    $data = [
      'no_faktur' => $this->request->getPost('en_faktur'),
      'tgl_jual' => date("Y-m-d"),
      'jam_jual' => date("H:i:s"),
      'total_harga' => $this->request->getPost('en_total_belanja'),
      'total_bayar' => $this->request->getPost('en_total_bayar'),
      'kembalian' => str_replace('.', '', $this->request->getPost('en_sisa_uang')),
    ];
    $result = $this->penjualan->insertData($data);

    if ($result){
      $respon = [
        "status" => true,
        "msg" => "Pembayaran Berhasil"
      ];
    }

    return $this->response->setJSON($respon);
  }
}
