<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => FALSE
            ],
            'photo' => [
                'type' => 'TEXT',
                'constraint' => 255,
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => TRUE
            ],
        ]
        );

            $this->forge->addKey('id', TRUE);
            $this->forge->createTable('users');
        }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
