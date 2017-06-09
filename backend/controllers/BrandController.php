<?php
	
	namespace backend\controllers;
	
	use crazyfd\qiniu\Qiniu;
	use backend\models\Brand;
	use yii\data\Pagination;
	use yii\web\Controller;
	use yii\web\UploadedFile;
	
	
	use xj\uploadify\UploadAction;
	
	class BrandController extends Controller
	{
		public function actionIndex()
		{
			$model = Brand::find()->where([ '<>', 'status', '-1' ]);
			
			$total = $model->count();
			$page = new Pagination([
									   'totalCount' => $total,
									   'defaultPageSize' => 2,
								   ]);
			$models = $model->offset($page->offset)->limit($page->limit)->all();
			return $this->render('index', [ 'brands' => $models, 'page' => $page ]);
		}
		
		public function actionAdd()
		{//添加
			$model = new Brand();
			if ($model->load(\Yii::$app->request->post())) {
//    		$model->imgFile=UploadedFile::getInstance($model,'imgFile');
				if ($model->validate()) {
					/*if($model->imgFile){
						$fileName='/images/brand/'.uniqid().'.'.$model->imgFile->extension;
						
						$model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
						$model->logo=$fileName;
					}*/
					$model->save();
					\Yii::$app->session->setFlash('success', '品牌添加成功');
					return $this->redirect([ 'brand/index' ]);
				} else {
					var_dump($model->getErrors());
					exit;
				}
			}
			
			return $this->render('add', [ 'model' => $model ]);
		}
		
		public function actionEdit($id)
		{
			$model = Brand::findOne([ 'id' => $id ]);
			if ($model->load(\Yii::$app->request->post())) {
//			$model->imgFile=UploadedFile::getInstance($model,'imgFile');
				if ($model->validate()) {
					/*if($model->imgFile){
						$fileName='/images/brand/'.uniqid().'.'.$model->imgFile->extension;
						$model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
						$model->logo=$fileName;
					}*/
					$model->save();
					\Yii::$app->session->setFlash('success', '品牌修改成功');
					return $this->redirect([ 'brand/index' ]);
				} else {
					var_dump($model->getErrors());
					exit;
				}
			}
			return $this->render('add', [ 'model' => $model ]);
		}
		
		public function actionDel($id)
		{
			$model = Brand::findOne([ 'id' => $id ]);
			
			$model->status = '-1';
			$model->save();
			\Yii::$app->session->setFlash('success', '品牌修改成功');
			\Yii::$app->session->setFlash('success', '品牌删除成功');
			return $this->redirect([ 'brand/index' ]);
		}
		
		public function actions()
		{
			return [
				's-upload' => [
					'class' => UploadAction::className(),
					'basePath' => '@webroot/upload',
					'baseUrl' => '@web/upload',
					'enableCsrf' => true, // default
					'postFieldName' => 'Filedata', // default
					//BEGIN METHOD
					'format' => [ $this, 'methodName' ],
					//END METHOD
					//BEGIN CLOSURE BY-HASH
					'overwriteIfExist' => true,
					/*'format' => function (UploadAction $action) {
						$fileext = $action->uploadfile->getExtension();
						$filename = sha1_file($action->uploadfile->tempName);
						return "{$filename}.{$fileext}";
					},*/
					//END CLOSURE BY-HASH
					//BEGIN CLOSURE BY TIME
					'format' => function (UploadAction $action) {
						$fileext = $action->uploadfile->getExtension();
						$filehash = sha1(uniqid() . time());
						$p1 = substr($filehash, 0, 2);
						$p2 = substr($filehash, 2, 2);
						return "{$p1}/{$p2}/{$filehash}.{$fileext}";
					},
					//END CLOSURE BY TIME
					'validateOptions' => [
						'extensions' => [ 'jpg', 'png' ],
						'maxSize' => 1 * 1024 * 1024, //file size
					],
					'beforeValidate' => function (UploadAction $action) {
						//throw new Exception('test error');
					},
					'afterValidate' => function (UploadAction $action) {
					},
					'beforeSave' => function (UploadAction $action) {
					},
					'afterSave' => function (UploadAction $action) {
						
						
						$imgUrl = $action->getWebUrl();
						$action->output['fileUrl'] = $action->getWebUrl();
						$qiniu = \Yii::$app->qiniu;
						$qiniu->uploadFile(\Yii::getAlias('@webroot') . $imgUrl, $imgUrl);
						$url = $qiniu->getLink($imgUrl);
						$action->output['fileUrl'] = $url;
						/*$action->getFilename(); // "image/yyyymmddtimerand.jpg"
						$action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
						$action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
						*/
					},
				],
			];
		}
		
		/*public function actionTest(){
			$ak = 'WHXsr4075A1KrBf71ihzM4-eeDU-F4PoexU6uBga';
			$sk = 'REb1eyWPvV9nd7pvc5IFpTW85pXCUsrp6slXkdKm';
			$domain = 'http://or9o8pc7h.bkt.clouddn.com/';
			$bucket = 'yiishop';
			
			$qiniu = new Qiniu($ak, $sk,$domain, $bucket);
			$key = time();
			$qiniu->uploadFile($_FILES['tmp_name'],$key);
			$url = $qiniu->getLink($key);
		}*/
		
	}
