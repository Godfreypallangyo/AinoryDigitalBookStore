<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\BookSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'book_isbn') ?>

    <?= $form->field($model, 'book_title') ?>

    <?= $form->field($model, 'book_author') ?>

    <?= $form->field($model, 'book_image') ?>

    <?= $form->field($model, 'book_file') ?>

    <?php // echo $form->field($model, 'book_descr') ?>

    <?php // echo $form->field($model, 'book_price') ?>

    <?php // echo $form->field($model, 'book_publisher_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
