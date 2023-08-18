<?php

use common\models\Clients;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\search\ClientsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    /* Style for pagination buttons */
.pagination.justify-content-center .page-item:not(.active) .page-link {
    color: #007bff; /* Blue color for inactive buttons */
    background-color: transparent;
    border: 1px solid #007bff;
}

.pagination.justify-content-center .page-item.active .page-link {
    color: #fff; /* White color for active button */
    background-color: #007bff;
    border-color: #007bff;
}

/* Style for previous and next buttons */
.pagination.justify-content-center .page-item:first-child .page-link,
.pagination.justify-content-center .page-item:last-child .page-link {
    padding: 0.25rem 0.5rem;
}

</style>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-8">
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => LinkPager::class,
            'hideOnSinglePage' => false, // Hide pagination if there's only one page
            'options' => ['class' => 'pagination justify-content-center'], // Customize the pagination container's class
            'prevPageLabel' => '< Previous', // Customize the "Previous" button label
            'nextPageLabel' => 'Next >', // Customize the "Next" button label
            // ... other pager options
        ],
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
