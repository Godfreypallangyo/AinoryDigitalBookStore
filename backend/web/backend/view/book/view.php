<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = $model->book_isbn;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'book_isbn' => $model->book_isbn], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'book_isbn' => $model->book_isbn], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'book_isbn',
            'book_title',
            'book_author',
            'book_image',
            'book_file',
            'book_descr:ntext',
            'book_price',
            'book_publisher_id',
        ],
    ]) ?>

</div>
