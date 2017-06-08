<?php
	header('Content-Type: text/html; charset=utf-8');
	$brandform=\yii\bootstrap\ActiveForm::begin();
	echo $brandform->field($model,'name')->textInput();
	echo $brandform->field($model,'intro')->textarea();
	
	if($model->logo)
	{
		echo \yii\bootstrap\Html::img($model->logo, [ 'class' => 'img-rounded col-md-1' ]);
	}
	echo $brandform->field($model,'imgFile')->fileInput();
	
	echo $brandform->field($model,'sort')->textInput();
	echo $brandform->field($model,'status',['inline'=>true])->radioList(\backend\models\Brand::$statusOptions);
	echo \yii\bootstrap\Html::submitInput($model->isNewRecord?'添加':'修改', [ 'class' => 'btn btn-info' ]);
	\yii\bootstrap\ActiveForm::end();