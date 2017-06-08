<?php

use yii\db\Migration;

/**
 * Handles the creation of table `yiishop`.
 */
class m170608_062730_create_yiishop_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
			'name'=>$this->string(50)->notNull()->comment('品牌名称'),
			'intro'=>$this->text()->notNull()->comment('品牌简介'),
			'logo'=>$this->string(255)->notNull()->comment('LOGO图片'),
			'sort'=>$this->integer(11)->notNull()->comment('品牌排序'),
			'status'=>$this->integer(2)->notNull()->comment('状态'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('yiishop');
    }
}
