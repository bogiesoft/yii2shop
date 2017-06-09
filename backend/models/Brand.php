<?php

namespace backend\models;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends ActiveRecord
{
//	public $imgFile;
	static public $statusOptions=[-1=>'删除',0=>'隐藏',1=>'正常'];
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'sort', 'status'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 255],
//			['imgFile','file','extensions'=>['jpg','png','gif']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '品牌名称',
            'intro' => '品牌简介',
            'imgFile' => 'LOGO图片',
            'sort' => '品牌排序',
            'status' => '状态',
        ];
    }
}
