<?php
/* @var $this MatrizController */
/* @var $model Matriz */

$this->breadcrumbs=array(
	'Matrizs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Matriz', 'url'=>array('index')),
	array('label'=>'Manage Matriz', 'url'=>array('admin')),
);
?>

<h1>Create Matriz</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>