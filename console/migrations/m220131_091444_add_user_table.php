<?php
use yii\db\Migration;

/**
* Class m220131_091444_add_user_table
*/
class m220131_091444_add_user_table extends Migration
{
	/**
	* {@inheritdoc}
	*/
	public function safeUp()
	{
		if ($this->db->getTableSchema('user', true) === null) {
			$this->createTable('user',
							[
							'id' => $this->primaryKey(),
							'username' => $this->string(128),
							'password' => $this->string(128),
							'status' => $this->integer()->defaultValue(1),
							'token' => $this->string(255),
							'created_at' => $this->dateTime(),
							'updated_at' => $this->dateTime(),
							]);
			$this->insert('user', ['username' => 'admin', 'password' => '21232f297a57a5a743894a0e4a801fc3']);
		}
	}

	/**
	* {@inheritdoc}
	*/
	public function safeDown()
	{
		$this->dropTable('user');
	}
}
