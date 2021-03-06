<?php
use Phinx\Migration\AbstractMigration;

class AddTokenToLinks extends AbstractMigration
{
    /**
     * Change Method.   
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('links');
        $table->addColumn('token', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex('token', array('unique' => true));

        $table->update();
       
    }
}
