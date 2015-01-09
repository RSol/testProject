<?php

class m150109_153415_create_follow_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_follow', array(
            'id' => 'pk',
            'name' => 'varchar (255)',
            'city' => 'varchar (255)',
            'zip' => 'int (11)',
            'state' => 'varchar (255)',
            'country' => 'varchar (255)',
        ));
	}

	public function down()
	{
		 $this->dropTable('tbl_follow');
	}
}