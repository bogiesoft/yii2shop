<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\Controller;

class ArticleCategoryController extends Controller
{
    public function actionIndex()
    {
    	
    	$model=ArticleCategory::find()->where(['<>','status','-1']);
		$total=$model->count();
		$page=new Pagination([
			'totalCount'=>$total,
			'defaultPageSize'=>2,
							 ]);
		$models=$model->offset($page->offset)->limit($page->limit)->all();
		return $this->render('index',['categorys'=>$models,'page'=>$page]);
    }
    public function actionAdd(){
    	$model=new ArticleCategory();
    	if($model->load(\Yii::$app->request->post())){
    		if($model->validate()){
    			$model->save();
				\Yii::$app->session->setFlash('success','分类添加成功');
				return $this->redirect(['article-category/index']);
			}else{
				var_dump($model->getErrors());
				exit;
		}
		}
		return $this->render('add',['model'=>$model]);
	}
	
	public function actionEdit($id){
    	$model=ArticleCategory::findOne(['id'=>$id]);
    	if($model->load(\Yii::$app->request->post())){
    		if($model->validate()){
				$model->save();
				\Yii::$app->session->setFlash('success','分类添加成功');
				return $this->redirect(['article-category/index']);
			}else{
				var_dump($model->getErrors());
				exit;
		}
		}
		return $this->render('add',['model'=>$model]);
	}
	
	public function actionDel($id){
		$model=ArticleCategory::findOne(['id'=>$id]);
		$model->status = -1;
		$model->save();
		\Yii::$app->session->setFlash('success', '品牌删除成功');
		return $this->redirect(['article-category/index']);
	}

}
