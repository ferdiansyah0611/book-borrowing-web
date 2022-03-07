<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class View extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('views');
	}

	public function down()
	{
		$this->forge->dropTable('views');
	}
}
