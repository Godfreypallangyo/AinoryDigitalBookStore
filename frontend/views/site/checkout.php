<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
// use \yii\widgets\ActiveFormAsset::register($this);
// use \yii\web\YiiAsset::register($this);


/** @var yii\web\View $this */
/** @var common\models\Clients $model */
/** @var yii\bootstrap5\ActiveForm $form */

$this->title = 'Checkout';

$total_amount = array_reduce($cartItems, function ($total, $item) {
    if ($item instanceof \common\models\Cart) {
        return $total + $item->bookIsbn->book_price;
    } else {
        return $total + $item['book_price'];
    }
}, 0);


// Convert to USD using exchange rate of 2490
$total_amount_usd = round($total_amount / 2490, 2);

?>
<script src="https://www.paypal.com/sdk/js?client-id=AYtN8GKvzwCAttBwoZSjguSxHaMAiSZYFLCP0ry1yTlMSQMLDEIRRiCUdGTvOL8l04NCk0h6UJMv3tzV&currency=USD"></script>
<style>
    #paymentContent {
        display: none;
        /* Hide the payment content initially */
    }
</style>

<div class="site-checkOut">
    <div class="container-fluid" style="margin-top:80px;">
        <div class="col-md-12" data-aos="fade-down" data-aos-delay="400">
            <div class="container" style="margin-top: 50px;">
                <!-- <h1 class="mb-4">Checkout</h1> -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Order Summary</h4>
                                <ul class="list-group">
                                    <?php foreach ($cartItems as $cartItem) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= Html::encode($cartItem instanceof \common\models\Cart ? $cartItem->bookIsbn->book_title : $cartItem['book_title']); ?>
                                            <span class="badge bg-secondary"><?= Yii::$app->formatter->currencyCode . ($cartItem instanceof \common\models\Cart ? $cartItem->bookIsbn->book_price : $cartItem['book_price']); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                    <!-- Calculate and display total price -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total
                                        <span class="badge bg-primary">
                                            <?= Yii::$app->formatter->currencyCode . $total_amount ?>
                                        </span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="card mb-4" id="clientForm">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Buyer Information</h4>

                                <div class="clients_form">
                                    <?php $form = ActiveForm::begin(['id' => 'checkout-form']); ?>
                                    <?= $form->field($model, 'name') ?>
                                    <?= $form->field($model, 'address') ?>
                                    <?= $form->field($model, 'city') ?>
                                    <?= $form->field($model, 'state') ?>
                                    <?= $form->field($model, 'country') ?>
                                    <?= $form->field($model, 'zipcode') ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('Done', [
                                            'id' => 'done-button',
                                            'class' => 'btn btn-primary',
                                            'name' => 'login-button',
                                        ]) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>

                                </div><!-- clients_form -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card " id="paymentContent">
                            <div class="card-header">
                                <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                                    <!-- <div class="content text-center">
									<img src="/images/payment-method.png" alt="#">
								</div> -->
                                    <!-- Credit card form tabs -->
                                    <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                        <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                                        <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link active"> <i class="fas fa-mobile-alt mr-2"></i> Moblie Money</a> </li>
                                    </ul>
                                </div> <!-- End -->
                                <div class="tab-content">
                                    <div id="net-banking" class="tab-pane active fade pt-3">
                                        <div class="form-group "> <label for="Select Your Bank">
                                                <h6>Select your Mobile Network</h6>
                                            </label> <select class="form-control" id="ccmonth">
                                                <option value="" selected disabled>--Please select your Mobile Network--</option>
                                                <option>Mpesa</option>
                                                <option>Tigo Pesa</option>
                                                <option>Airtel Money</option>
                                            </select> </div>
                                        <div class="form-group">
                                            <p> <button type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button> </p>
                                        </div>
                                        <p class="text-muted">Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                                    </div> <!-- End -->
                                    <!-- Paypal info -->
                                    <div id="paypal" class="tab-pane  fade pt-3">
                                        <!-- Set up a container element for the button -->
                                        <div id="paypal-button-container"></div>
                                        <script>
                                            var order_number = '<?php echo Yii::$app->session->get('currentOrderId') . ''; ?>';
                                            paypal.Buttons({
                                                createOrder: function(data, actions) {
                                                    return actions.order.create({
                                                        purchase_units: [{
                                                            amount: {
                                                                value: <?php echo $total_amount_usd ?>
                                                            },
                                                            custom_id: '<?php echo Yii::$app->session->get('currentOrderId') . ''; ?>'
                                                        }]
                                                    });
                                                },
                                                onApprove: function(data, actions) {
                                                    var orderID = data.orderID;
                                                    var clientFormData = <?= json_encode(Yii::$app->session->get('clientFormData')) ?>;
                                                    var client_id = <?= Yii::$app->session->get('clientId') ?>;
                                                    console.log(client_id);
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '<?= Yii::$app->urlManager->createUrl(['/site/update-payment-status']) ?>',
                                                        data: {
                                                            clientID: client_id,
                                                            clientFormData: JSON.stringify(clientFormData),
                                                            payment_method: data.paymentSource,
                                                            payment_status: 1
                                                        },
                                                        headers: {
                                                            'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                                                        },
                                                        success: function(response) {
                                                            <?php
                                                            foreach ($cartItems as $cartItem) {
                                                                $fileUrl = Yii::$app->urlManager->createUrl([
                                                                    '/site/download',
                                                                    'file' => $cartItem instanceof \common\models\Cart ? $cartItem->bookIsbn->book_file : $cartItem['book_file'],
                                                                    'user_id' => Yii::$app->user->isGuest ? null : Yii::$app->user->id
                                                                ]);
                                                                echo "console.log('$fileUrl');";
                                                                echo "window.open('$fileUrl', '_blank');";
                                                            }
                                                            ?>

                                                            if (response.success) {
                                                                console.log(response.message);

                                                            } else {
                                                                console.error(response.message);
                                                            }
                                                        },
                                                        error: function() {
                                                            console.error('Error sending AJAX request');
                                                        }
                                                    });

                                                }

                                            }).render('#paypal-button-container');
                                        </script>

                                    </div> <!-- End -->


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function toggleFormAndPayment() {
        var clientForm = document.getElementById('clientForm');
        var paymentContent = document.getElementById('paymentContent');

        clientForm.style.display = 'none';
        paymentContent.style.display = 'block';
    }
    var checkoutUrl = '<?= Url::to(['site/process-checkout']) ?>';

    document.getElementById('done-button').addEventListener('click', function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('checkout-form'));

        fetch(checkoutUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hide the form and show the payment content
                    toggleFormAndPayment();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>