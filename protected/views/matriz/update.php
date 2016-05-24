<?php
/* @var $this MatrizController */
/* @var $model Matriz */

$this->breadcrumbs=array(
	'Matrizs'=>array('index'),
	$model->ID_MATRIZ=>array('view','id'=>$model->ID_MATRIZ),
	'Update',
);

$this->menu=array(
	array('label'=>'List Matriz', 'url'=>array('index')),
	array('label'=>'Create Matriz', 'url'=>array('create')),
	array('label'=>'View Matriz', 'url'=>array('view', 'id'=>$model->ID_MATRIZ)),
	array('label'=>'Manage Matriz', 'url'=>array('admin')),
);
?>

<h1>Update Matriz <?php echo $model->ID_MATRIZ; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>