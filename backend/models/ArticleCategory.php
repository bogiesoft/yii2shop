<?php

namespace backend\models;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $sort
 * @property integer $status
 * @property integer $is_help
 */
class ArticleCategory extends ActiveRecord
{
	static public $statusOptions=[-1=>'删除',0=>'隐藏',1=>'正常'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'sort', 'status', 'is_help'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status', 'is_help'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章分类名',
            'intro' => '文章分类简介',
            'sort' => '文章分类排序',
            'status' => '文章分类状态',
            'is_help' => '文章分类类型',
        ];
    }
}
