<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblDetailPenjualan extends Migration
{
    public function up()
	{
		$this->forge->addField([
      'id_detail_penjualan'=> [
				'type'           => 'int',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'no_faktur' => [
				'type'		=> 'int',
				'constraint' => '11',
			],
			'kode_produk' => [
				'type'		=> 'int',
				'constraint' => '15',
			],
			'nama_produk' => [
				'type'		=> 'varchar',
				'constraint' => '25',
			],
			'qty' => [
				'type' => 'int',
				'constraint' => '11',
			],
			'harga_jual' => [
				'type' => 'float',
				'constraint' => '11',
			],
			'total_harga' => [
				'type' => 'float',
				'constraint' => '11',
			],
		]);
		$this->forge->createTable('tbl_detail_penjualan');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_detail_penjualan');
	}
}
