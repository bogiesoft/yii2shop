<?= \yii\bootstrap\Html::a('添加', [ 'article/add' ], [ 'class' => 'btn btn-primary' ]); ?>
<table class="table table-bordered table-hover wy-table-striped">
	<tr>
		<th>ID</th>
		<th>文章名称</th>
		<th>文章内容</th>
		<th>文章简介</th>
		<th>文章分类</th>
		<th>文章排序</th>
		<th>发表时间</th>
		<th>文章状态</th>
		<th>操作</th>
	</tr>
	<?php foreach ($articles as $article): ?>
		<tr>
			<td><?= $article->id ?></td>
			<td><?= $article->name ?></td>
			<td><?= \yii\bootstrap\Html::a(mb_substr($article->contents->content, 0, 8, 'utf-8'), [ 'article-detail/index', 'id' => $article->id ], [ 'class' => 'btn btn-info btn-xs btn-block' ]) ?></td>
			<td><?= $article->intro ?></td>
			<td><?= $article->article->name ?></td>
			<td><?= $article->sort ?></td>
			<td><?= date('Y-m-d,H:i:s', $article->create_time) ?></td>
			<td><?= \backend\models\Article::$statusOptions[$article->status] ?></td>
			<td>
				<?= \yii\bootstrap\Html::a('修改', [ 'article/edit', 'id' => $article->id ], [ 'class' => 'btn btn-warning btn-xs' ]) ?>
				<?= \yii\bootstrap\Html::a('删除', [ 'article/del', 'id' => $article->id ], [ 'class' => 'btn btn-danger btn-xs' ]) ?>

			</td>
		</tr>
	<?php endforeach; ?>
</table>
<?= \yii\widgets\LinkPager::widget([ 'pagination' => $page ]); ?>
	




