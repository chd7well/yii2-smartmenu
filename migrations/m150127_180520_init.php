<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_180520_init extends Migration
{
    public function up()
    {
    	$this->createTable('{{%sys_menu_type}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'type'        => Schema::TYPE_STRING . '(255) NOT NULL',
    	]);
    	$this->createTable('{{%sys_menu}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'label'        => Schema::TYPE_STRING . '(255) NOT NULL',
    			'url'		   		   => Schema::TYPE_TEXT,
    			'parent_ID'		   => Schema::TYPE_INTEGER,
    			'comment'		   	   => Schema::TYPE_STRING . '(255)',
    			'weight'				=> Schema::TYPE_SMALLINT,
    			'type_ID'			   => Schema::TYPE_INTEGER,
    			'noguest'            => Schema::TYPE_BOOLEAN,
    	]);
    	$this->addForeignKey('fk_sys_menu_sys_menu_type', '{{%sys_menu}}', 'type_ID', '{{%sys_menu_type}}', 'ID');
    	$this->addForeignKey('fk_sys_menu_sys_menu', '{{%sys_menu}}', 'parent_ID', '{{%sys_menu}}', 'ID');
    	$this->insert('{{%sys_menu_type}}', ['ID'=>1, 'type'=>'mainmenu']);
    }

    public function down()
    {
         $this->dropTable('{{%sys_menu}}');
         $this->dropTable('{{%sys_menu_type}}');
    }
}
