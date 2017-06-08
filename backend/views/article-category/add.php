<?php
	header('Content-Type: text/html; charset=utf-8');
	$categoryform=\yii\bootstrap\ActiveForm::begin();
	echo $categoryform->field($model,'name')->textInput();
	echo $categoryform->field($model,'intro')->textarea();
	echo $categoryform->field($model,'sort')->textInput();
	echo $categoryform->field($model,'is_help')->textInput();
	echo $categoryform->field($model,'status',['inline'=>true])->radioList(\backend\models\ArticleCategory::$statusOptions);
	echo \yii\bootstrap\Html::submitInput($model->isNewRecord?'添加':'修改', [ 'class' => 'btn btn-info' ]);
	\yii\bootstrap\ActiveForm::end();