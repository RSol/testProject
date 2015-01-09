<?php

class m150109_140820_create_email_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_email', array(
            'follow_id' => 'int (11)',
            'email' => 'varchar (255)',
        ));
	}

	public function down()
	{
		 $this->dropTable('tbl_email');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}