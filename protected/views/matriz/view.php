<?php
/* @var $this MatrizController */
/* @var $model Matriz */

$this->breadcrumbs=array(
	'Matrizs'=>array('index'),
	$model->ID_MATRIZ,
);

$this->menu=array(
	array('label'=>'List Matriz', 'url'=>array('index')),
	array('label'=>'Create Matriz', 'url'=>array('create')),
	array('label'=>'Update Matriz', 'url'=>array('update', 'id'=>$model->ID_MATRIZ)),
	array('label'=>'Delete Matriz', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_MATRIZ),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Matriz', 'url'=>array('admin')),
);
?>

<h1>View Matriz #<?php echo $model->ID_MATRIZ; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_MATRIZ',
		'CODIGO',
		'NOMBRE_MATRIZ',
	),
)); ?>
