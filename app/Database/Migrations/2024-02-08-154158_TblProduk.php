<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblProduk extends Migration
{
    public function up()
	{
		$this->forge->addField([
            'id_produk'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'kode_produk'          => [
				'type'           => 'char',
				'constraint'     => '50',
			],
			'nama_produk'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
            'kategori_id' => [
                'type' => 'int',
                'constraint' => '11'
            ],
			'satuan_id' => [
				'type' => 'int',
				'constraint' => '11'
			],
			'harga_beli' => [
				'type' => 'float',
				'constraint' => '11',
				'default' => 0.00
			],
			'harga_jual' => [
				'type' => 'float',
				'constraint' => '11',
				'default' => 0.00
            ],
            'stok_produk' => [
				'type' => 'int',
				'constraint' => '11',
			],
		]);
		$this->forge->addKey('id_produk', true);
		$this->forge->addForeignKey('kategori_id', 'tbl_kategori', 'id_kategori', 'cascade');
		$this->forge->addForeignKey('satuan_id', 'tbl_satuan', 'id_satuan', 'cascade');
		$this->forge->createTable('tbl_produk');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_produk');
	}
}
