<?php

use common\models\Cart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\search\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Carts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'user_id',
                    'book_isbn',
                    'created_at',
                    'updated_at',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Cart $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-md-4">
            <h2>Search Cart</h2>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>


    <?php Pjax::end(); ?>

</div>