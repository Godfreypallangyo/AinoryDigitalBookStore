<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\Clients $model */
/** @var yii\bootstrap5\ActiveForm $form */

$this->title = 'Checkout';
?>
<div class="site-checkOut">
<div class="container" style="margin-top:80px;">
    <div class="col-md-12" data-aos="fade-down" data-aos-delay="400">
        <div class="container" style="margin-top: 50px;">
            <h1 class="mb-4">Checkout</h1>
            <div class="row">
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Order Summary</h4>
                            <ul class="list-group">
                                <?php foreach ($cartItems as $item) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= Html::encode($item['book_title']); ?>
                                        <span class="badge bg-secondary"><?= Yii::$app->formatter->currencyCode . $item['book_price']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                                <!-- Calculate and display total price -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total
                                    <span class="badge bg-primary">
                                        <?= Yii::$app->formatter->currencyCode ?>
                                        <?= array_reduce($cartItems, function ($total, $item) {
                                            return  $total + $item['book_price'];
                                        }, 0); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <!-- <div class="single-widget payement text-center">
								<div class="content">
									<img src="/images/payment-method.png" alt="#">
								</div>
							</div> -->
							<!--/ End Payment Method Widget -->
							<!-- Button Widget -->
							<!-- <div class="single-widget get-button">
								<div class="content">
                                <button type="submit" class="btn btn-primary m-auto">Proceed to Payment</button>

								</div>
							</div> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Buyer Information</h4>

                            <div class="clients_form">
                                <?php $form = ActiveForm::begin(); ?>

                                <?= $form->field($model, 'name') ?>
                                <?= $form->field($model, 'address') ?>
                                <?= $form->field($model, 'city') ?>
                                <?= $form->field($model, 'state') ?>
                                <?= $form->field($model, 'country') ?>
                                <?= $form->field($model, 'zipcode') ?>

                                <div class="form-group">
                                    <?= Html::a('Submit and Proceed to Payment', Url::to(['site/payments']) ,['class' => 'btn btn-primary']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>

                            </div><!-- clients_form -->
                        </div>
                    </div>
                </div>
                                    </div>
                

            </div>
        </div>
    </div>
</div>