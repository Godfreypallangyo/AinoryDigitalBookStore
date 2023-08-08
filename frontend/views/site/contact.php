<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="row">
        <div class="site-section bg-light" id="contact-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h3 class="section-sub-title">Contact Form</h3>
                        <h2 class="section-title mb-3">Get In Touch</h2>
                        <p>
                            If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7 mb-5">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                        <form action="#" class="p-5 bg-white">
                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'email') ?>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'subject') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                    ]) ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" value="Send Message" name="contact-button" class="btn btn-black rounded-0 py-3 px-4">
                                </div>
                            </div>
                        </form>
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

</div>