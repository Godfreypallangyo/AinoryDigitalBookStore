<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = 'Update Book: ' . $model->book_isbn;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book_isbn, 'url' => ['view', 'book_isbn' => $model->book_isbn]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
