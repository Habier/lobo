<?php

use app\components\Sortable;

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesColores */

$this->title = 'Update Animales Colores: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Animales Colores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'animal_id' => $model->nombre, 'color_id' => $model->nombre]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animales-colores-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Sortable::widget([
            'view' => $this,
            'list_id' => $model->id,
            'item_view' => '/colores/_color',
            'sortable1' => [
                'accion' => Url::to(['animales-colores/create']) ,
                'items' => $model->colors,
            ],
            'sortable2' => [
                'accion' => Url::to(['animales-colores/delete']) ,
                'items' => $model->getColoresQueNoTengo(),
            ],
        ])
    ?>

    <div class="">
        <?= Html::a('He terminado', ['animales/index'], ['class' => 'btn btn-info']) ?>
    </div>

</div>
