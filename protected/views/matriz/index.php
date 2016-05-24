<?php
/* @var $this MatrizController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Matrizs',
);

$this->menu=array(
	array('label'=>'Create Matriz', 'url'=>array('create')),
	array('label'=>'Manage Matriz', 'url'=>array('admin')),
);
?>

<h1>Matrizs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
