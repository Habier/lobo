<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnfermedadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enfermedades';
$this->params['breadcrumbs'][] = $this->title;
$url = Url::to(['enfermedades-sintomas/create']);

$js = <<<EOT
    $( ".panel-heading" ).click(function() {
        console.log($(this).find('p'));
        $(this).siblings('p').toggle(200);
    });
    $( ".desplegarFrom" ).click(function() {
        $('form .sintoma').hide(200);
        $(this).siblings('form').toggle(200);
    });
    $('.submit').click((e)=>{
        var enfermedad_id = $(e.target).data('enfermedad');
        var sintoma_id = $(e.target).siblings('select').val();

        $('').change(function(e){
            e.preventDefault();

            $.ajax({
                method: 'POST',
                url: '$url',
                data: {
                    enfermedad_id: enfermedad_id,
                    sintoma_id: sintoma_id
                    },
                success: function(result){

                }
            });
        });
        EOF;

        $this->registerJs($js);
        ?>
    })
EOT;

$this->registerJs($js);
?>

<div class="enfermedades-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Enfermedades', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="row">

    <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_detalle',
        ]);
    ?>
</div>

</div>
