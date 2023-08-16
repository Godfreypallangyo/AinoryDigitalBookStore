<?php

use common\models\Orders;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\search\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
<div class="row">
    <div class="col-md-8">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'pager' => [
            'options' => ['class' => 'pagination'], // Add a class to the pager container
            'prevPageLabel' => 'Previous', // Customize the previous page label
            'nextPageLabel' => 'Next', // Customize the next page label
            // You can further customize pager options as needed
        ],
        'columns' => [
            'id',
            'client_id',
            'order_number',
            'order_total',
            'payment_status',
            'payment_method',
            'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <div class="col-md-4">
        <h2>Search Order</h2>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    </div>
</div>
    

    <?php Pjax::end(); ?>

</div>
