<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AccountVerify extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE
            ],
            'expired' => [
                'type' => 'DATETIME',
                'null' => FALSE
            ],
        ]);

            $this->forge->addKey('id', TRUE);
            $this->forge->createTable('account_verify');
    }

    public function down()
    {
        $this->forge->dropTable('account_verify');
    }
}
