<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblSatuan extends Migration
{
    public function up()
	{
		$this->forge->addField([
			'id_satuan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'nama_satuan'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			]
		]);
		$this->forge->addKey('id_satuan', true);
		$this->forge->createTable('tbl_satuan');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_satuan');
	}
}
