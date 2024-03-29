<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DonaturSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Donatur';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="donatur-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Donatur', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nama',
            //'username',
            //'password',
            'tgl_lahir',
            'alamat:ntext',
            'hp',
            'email:email',
            // 'foto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
