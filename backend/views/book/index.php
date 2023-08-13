<?php

use common\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'book_isbn',
                'contentOptions'=>[
                    'style'=>'width:50px'
                ]
            ],
            [  
                'attribute'=>'book_image',
                'content'=>function($model){
                    /**
                 * @var  \common\models\Book $model
                 */
                return Html::img($model->getImageUrl(),['style'=>'width:70px']);
                }
            ],
            'book_title',
            'book_author',
            // 'book_file',
            //'book_descr:ntext',
            'book_price:currency',
            //'book_publisher_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'book_isbn' => $model->book_isbn]);
                 }
            ],
        ],
    ]); ?>
    
</div>
