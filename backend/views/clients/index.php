<?php

use common\models\Clients;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\ClientsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-8">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'address',
            'city',
            'state',
            'country',
            //'zipcode',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Clients $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    </div>
    <div class="col-md-4">
        <h2>Search a client</h2>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    </div>
</div>

</div>
