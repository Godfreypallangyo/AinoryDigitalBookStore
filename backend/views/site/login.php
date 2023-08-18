<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<div class="row">
    <div class="col-lg-6 d-none d-lg-block">
        
                <!-- Impressive HTML content -->
                <h1 class="text-center mb-4">Welcome, Admin!</h1>
                <div class="text-center" style="margin-top: 100px;">
                    <p id="changing-text" class="h3">Stay tuned for exciting updates...</p>
                </div>
    </div>
    <div class="col-lg-6">
        <div class="p-5">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'user']
            ]);
            ?>

            <?= $form->field(
                $model,
                'username',
                [
                    'inputOptions' => [
                        'class' => 'form-control form-control-user',
                        'placeholder' => 'Enter your username'
                    ]
                ]
            )->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password', [
                'inputOptions' => [
                    'class' => 'form-control form-control-user',
                    'placeholder' => 'Enter your password'
                ]
            ])->passwordInput() ?>

            <?= $form->field($model, 'rememberMe', [
                'inputOptions' => [
                    'class' => 'form-control form-control-user'
                ]
            ])->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-user', 'name' => 'login-button']) ?>
            </div>

            <hr>
            <?php ActiveForm::end(); ?>
            <hr>
            <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
<script>
    const changingText = document.getElementById('changing-text');
    const texts = ["Stay tuned for exciting updates...", "Explore new features coming soon!", "Experience the power of our platform."];
    let index = 0;

    function changeText() {
        changingText.textContent = texts[index];
        index = (index + 1) % texts.length;
    }

    setInterval(changeText, 5000); 
</script>