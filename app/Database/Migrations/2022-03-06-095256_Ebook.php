<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ebook extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'          => [
                'type' => 'INT',
                'constraint'  => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'title' => [
                'type'  => 'VARCHAR',
                'constraint' => 255
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ebooks');
	}

	public function down()
	{
		$this->forge->dropTable('ebooks');
	}
}
