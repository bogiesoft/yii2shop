<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;

class BrandController extends Controller
{
    public function actionIndex()
    {
    	$model=Brand::find()->where(['<>','status','-1']);
    	
		$total=$model->count();
		$page=new Pagination([
			'totalCount'=>$total,
			'defaultPageSize'=>2,
							 ]);
		$models=$model->offset($page->offset)->limit($page->limit)->all();
		return $this->render('index',['brands'=>$models,'page'=>$page]);
    }
    
    public function actionAdd(){//添加
    	$model=new Brand();
    	if($model->load(\Yii::$app->request->post())){
    		$model->imgFile=UploadedFile::getInstance($model,'imgFile');
    		if($model->validate()){
				if($model->imgFile){
					$fileName='/images/brand/'.uniqid().'.'.$model->imgFile->extension;
					
					$model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
					$model->logo=$fileName;
				}
				$model->save();
				\Yii::$app->session->setFlash('success','品牌添加成功');
				return $this->redirect(['brand/index']);
			}else{
    			var_dump($model->getErrors());
    			exit;
			}
		}
    	
    	return $this->render('add',['model'=>$model]);
	}
	
	public function actionEdit($id){
    	$model=Brand::findOne(['id'=>$id]);
    	if($model->load(\Yii::$app->request->post())){
			$model->imgFile=UploadedFile::getInstance($model,'imgFile');
			if($model->validate()){
			if($model->imgFile){
				$fileName='/images/brand/'.uniqid().'.'.$model->imgFile->extension;
				$model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
				$model->logo=$fileName;
			}
			$model->save();
			\Yii::$app->session->setFlash('success','品牌修改成功');
			return $this->redirect(['brand/index']);
		}else{
				var_dump($model->getErrors());
				exit;
			}
		}
		return $this->render('add',['model'=>$model]);
	}
	public function actionDel($id){
		$model=Brand::findOne(['id'=>$id]);
		
		$model->status='-1';
		$model->save();
		\Yii::$app->session->setFlash('success','品牌修改成功');
		\Yii::$app->session->setFlash('success','品牌删除成功');
		return $this->redirect(['brand/index']);
	}
	
}
