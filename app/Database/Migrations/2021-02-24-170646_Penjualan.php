<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_penjualan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'no_faktur' => [
				'type'		=> 'char',
				'constraint' => '20',
				'null'		=> false
			],
			'tgl_jual' => [
				'type'		=> 'date',
				'null'		=> false
			],
			'jam_jual' => [
				'type'		=> 'timestamp',
				'null'		=> false
			],
			'jual_pelkode' => [
				'type' => 'int',
				'constraint' => '11',
			],
			'total_harga' => [
				'type' => 'float',
				'constraint' => '11',
			],
			'total_bayar' => [
				'type' => 'float',
				'constraint' => '11',
			],
			'kembalian' => [
				'type' => 'float',
				'constraint' => '11',
			],
		]);

		$this->forge->createTable('tbl_penjualan');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_penjualan');
	}
}