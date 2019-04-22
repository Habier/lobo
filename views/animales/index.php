<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Animales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'especie.especie:text:Grupo',
            'nombre',
            'nacimiento',
            'chip',
            'peso:weight',
            'ppp:boolean',
            'esterilizado:boolean',
            'sexo',
            'observaciones:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>