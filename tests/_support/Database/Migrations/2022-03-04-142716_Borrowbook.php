<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class Borrowbook extends Migration
{
    protected $DBGroup = 'tests';
	public function up()
	{
		$this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'       => [
                'type' => 'INT'
            ],
            'book_id' => [
                'type'       => 'INT',
            ],
            'start' => [
                'type' => 'DATETIME',
            ],
            'end' => [
                'type' => 'DATETIME',
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
        $this->forge->createTable('borrow_books');
	}

	public function down()
	{
		$this->forge->dropTable('borrow_books');
	}
}
