<?php

class m150105_101619_create_news_table extends CDbMigration
{
	public function up()
	{
		 $this->createTable('tbl_country', array(
            'id' => 'pk',
            'name' => 'text',
        ));
		 
		 $this->insert('tbl_country', array(
            'name' => 'Armenia',
        ));
		 $this->insert('tbl_country', array(
            'name' => 'Bolivia',
        ));
		 $this->insert('tbl_country', array(
            'name' => 'USA',
        ));
		 $this->insert('tbl_country', array(
            'name' => 'Ukraine',
        ));
		 $this->insert('tbl_country', array(
            'name' => 'Uganda',
        ));
	}

	public function down()
	{
		 $this->dropTable('tbl_country');
	}

}