<?php
	header('Content-Type: text/html; charset=utf-8');
	$articform = \yii\bootstrap\ActiveForm::begin();
	echo $articform->field($model, 'name')->textInput();
	echo $articform->field($content, 'content')->textarea();
	echo $articform->field($model, 'intro')->textarea();
	echo $articform->field($model, 'article_category_id')->dropDownList(\yii\helpers\ArrayHelper::map($cates, 'id', 'name'));
	echo $articform->field($model, 'sort')->textInput();
	echo $articform->field($model, 'status', [ 'inline' => true ])->radioList(\backend\models\Article::$statusOptions);
	echo \yii\bootstrap\Html::submitInput($model->isNewRecord ? '添加' : '修改', [ 'class' => 'btn btn-info' ]);
	\yii\bootstrap\ActiveForm::end();