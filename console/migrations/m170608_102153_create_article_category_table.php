<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170608_102153_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
			'name'=>$this->string(50)->notNull()->comment('文章分类名'),
			'intro'=>$this->text()->notNull()->comment('文章分类简介'),
			'sort'=>$this->integer(11)->notNull()->comment('文章分类排序'),
			'status'=>$this->integer(2)->notNull()->comment('文章分类状态'),
			'is_help'=>$this->integer(1)->notNull()->comment('文章分类类型'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
