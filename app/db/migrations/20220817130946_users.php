<?php
declare(strict_types=1);
use Phinx\Migration\AbstractMigration;


final class Users extends AbstractMigration
{
    public function up()
    {
        $this->table('users')
             ->addColumn('name', 'string', ['limit' => 80])
             ->addColumn('age', 'integer')
             ->addColumn('email', 'string', ['limit' => 50])
             ->addColumn('password', 'string')
             ->addTimestamps()
             ->save();
    }

    public function down()
    {
        $this->table('users')->drop()->save();
    }
}
