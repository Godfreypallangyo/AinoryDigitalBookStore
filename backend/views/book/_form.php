<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'book_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_publisher_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
