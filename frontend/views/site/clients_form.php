<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Clients $model */
/** @var ActiveForm $form */
?>
<div class="clients_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'state') ?>
        <?= $form->field($model, 'country') ?>
        <?= $form->field($model, 'zipcode') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- clients_form -->
