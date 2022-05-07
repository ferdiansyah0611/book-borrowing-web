<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class Book extends Migration
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
                'type'       => 'INT',
            ],
            'name' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'name_publisher' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'year_publisher' => [
                'type' => 'YEAR',
                'null' => true,
            ],
            'author' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => true,
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
        $this->forge->createTable('books');
	}

	public function down()
	{
		$this->forge->dropTable('books');
	}
}
