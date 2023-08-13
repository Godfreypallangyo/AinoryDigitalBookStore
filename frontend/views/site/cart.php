<?php
use yii\helpers\Html;

$this->title = 'My Cart';
use yii\helpers\Url;

?>

<div class="site-cart">
    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md-12">
                <h1>Shopping Cart</h1>
                <?php if (empty($cartItems)) : ?>
                    <p>Your cart is empty.</p>
                <?php else : ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item) : ?>
                                <tr>
                                    <td><?= Html::encode($item->book_title); ?></td>
                                    <td><?=Yii::$app->formatter->currencyCode . $item->book_price; ?></td>
                                    <td>
                                        <?= Html::a('Remove', ['site/remove-item', 'book_isbn' => $item->book_isbn], ['class' => 'btn btn-danger']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Total Items: <?= count($cartItems); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p>Total Price: <?=Yii::$app->formatter->currencyCode . array_reduce($cartItems, function ($carry, $item) {
                                return $carry + $item->book_price;
                            }, 0); ?></p>
                        </div>
                    </div>
                    <div class="text-center">
                    <?= Html::a('Checkout', Url::to(['site/checkout']), ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
