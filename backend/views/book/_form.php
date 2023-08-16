<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="book-form col-md-6">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'book_isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bookImage',[
        'template'=>'
        
        <div class="custom-file">
        {input}
        {label}
        {error}
        </div>
        ',
        'inputOptions'=>['class'=>'custom-file-input'],
        'labelOptions'=>['class'=>'custom-file-label'] 
    ])->textInput(['type'=>'file']) ?>

<?= $form->field($model, 'bookFile',[
        'template'=>'
        
        <div class="custom-file">
        {input}
        {label}
        {error}
        </div>
        ',
        'inputOptions'=>['class'=>'custom-file-input'],
        'labelOptions'=>['class'=>'custom-file-label'] 
    ])->textInput(['type'=>'file']) ?>

    <?= $form->field($model, 'book_descr')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'book_price')->textInput(['maxlength' => true,
    'maxlength'=>true,
    'type'=>'number'
    
    ]) ?>

    <?= $form->field($model, 'book_publisher_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>