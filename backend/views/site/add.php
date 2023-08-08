<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = 'Add New Book';
?>

<h1><?= Html::encode($this->title) ?></h1>
<?= $form->errorSummary($model) ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'isbn')->textInput() ?>
    <?= $form->field($model, 'title')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'author')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <?= $form->field($model, 'file')->fileInput() ?>
    <?= $form->field($model, 'descr')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'price')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'publisher')->textInput(['required' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Add new book', ['class' => 'btn btn-primary mt-12']) ?>
        <?= Html::a('Cancel', ['/site/index'], ['class' => 'btn btn-default']) ?>
    </div>
<?php ActiveForm::end(); ?>

