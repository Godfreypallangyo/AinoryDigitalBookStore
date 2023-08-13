<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\OrderedBook $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ordered-book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
