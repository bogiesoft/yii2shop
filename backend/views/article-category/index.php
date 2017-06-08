<?=\yii\bootstrap\Html::a('添加',['article-category/add'],['class'=>'btn btn-primary']);?>
<table class="table table-bordered table-hover wy-table-striped">
	<tr>
		<th>ID</th>
		<th>文章分类名称</th>
		<th>文章分类简介</th>
		<th>文章分类排序</th>
		<th>文章分类状态</th>
		<th>文章分类类型</th>
		<th>操作</th>
	</tr>
	<?php foreach ($categorys as $category):?>
		<tr>
			<td><?=$category->id?></td>
			<td><?=$category->name?></td>
			<td><?=$category->intro?></td>
			<td><?=$category->sort?></td>
			<td><?=$category->is_help?></td>
			<td><?=\backend\models\ArticleCategory::$statusOptions[$category->status]?></td>
			<td>
				<?=\yii\bootstrap\Html::a('修改',['article-category/edit','id'=>$category->id],['class'=>'btn btn-warning btn-xs'])?>
				<?=\yii\bootstrap\Html::a('删除',['article-category/del','id'=>$category->id],['class'=>'btn btn-danger btn-xs'])?>
			
			</td>
		</tr>
	<?php endforeach;?>
</table>

<?php
	echo \yii\widgets\LinkPager::widget([
		'pagination'=>$page,
										]);
	
?>



