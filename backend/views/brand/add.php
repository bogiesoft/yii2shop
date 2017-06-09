<?php
	use yii\web\JsExpression;
	header('Content-Type: text/html; charset=utf-8');
	$brandform=\yii\bootstrap\ActiveForm::begin();
	echo $brandform->field($model,'name')->textInput();
	echo $brandform->field($model,'intro')->textarea();
	echo $brandform->field($model,'logo')->hiddenInput();
	
	
	/*if($model->logo)
	{
		echo \yii\bootstrap\Html::img($model->logo, [ 'class' => 'img-rounded col-md-1' ]);
	}*/
	
//	echo $brandform->field($model,'imgFile')->fileInput(['id'=>'test']);
	echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
	
	echo \xj\uploadify\Uploadify::widget([
							   'url' => yii\helpers\Url::to(['s-upload']),
							   'id' => 'test',
							   'csrf' => true,
							   'renderTag' => false,
							   'jsOptions' => [
								   'width' => 120,
								   'height' => 40,
								   'onUploadError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
								   ),
								   'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        
      
        $('#logos').hide();
        
        $('#img_logo').attr('src',data.fileUrl).show();
        $("#brand-logo").val(data.fileUrl);
    }
}
EOF
								   ),
							   ]
						   ]);
	if($model->logo){
		echo \yii\bootstrap\Html::img('@web'.$model->logo,[ 'class' => 'img-rounded col-md-1','id'=>'logos']);
	}
	echo \yii\bootstrap\Html::img('', [ 'class' => 'img-rounded col-md-1','style'=>'display:none','id'=>'img_logo']);
	echo $brandform->field($model,'sort')->textInput();
	echo $brandform->field($model,'status',['inline'=>true])->radioList(\backend\models\Brand::$statusOptions);
	echo \yii\bootstrap\Html::submitInput($model->isNewRecord?'添加':'修改', [ 'class' => 'btn btn-info' ]);
	\yii\bootstrap\ActiveForm::end();