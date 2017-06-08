<?=\yii\bootstrap\Html::a('添加',['brand/add'],['class'=>'btn btn-primary']);?>
<table class="table table-bordered table-hover wy-table-striped">
	<tr>
		<th>ID</th>
		<th>品牌名称</th>
		<th>品牌logo</th>
		<th>品牌简介</th>
		<th>品牌排序</th>
		<th>品牌状态</th>
		<th>操作</th>
	</tr>
	<?php foreach ($brands as $brand):?>
		<tr>
			<td><?=$brand->id?></td>
			<td><?=$brand->name?></td>
			<td><?=($brand->logo)?\yii\bootstrap\Html::img($brand->logo,['class'=>'img-rounded col-md-2']):''?></td>
			<td><?=$brand->intro?></td>
			<td><?=$brand->sort?></td>
			<td><?=\backend\models\Brand::$statusOptions[$brand->status]?></td>
			<td>
				<?=\yii\bootstrap\Html::a('修改',['brand/edit','id'=>$brand->id],['class'=>'btn btn-warning btn-xs'])?>
				<?=\yii\bootstrap\Html::a('删除',['brand/del','id'=>$brand->id],['class'=>'btn btn-danger btn-xs'])?>
			
			</td>
		</tr>
	<?php endforeach;?>
</table>

<?php
	echo \yii\widgets\LinkPager::widget([
		'pagination'=>$page,
										]);
	
?>



