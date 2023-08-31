<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Cart';
?>

<div class="site-cart">
    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md-12 text-center justify-content-center">
                <h1>Shopping Cart</h1>
                <?php if (empty($cartItems)) : ?>
                    <span class="fixed-dimensions lazy-load-image-background blur lazy-load-image-loaded" style="color: transparent; display: inline-block; height: 301px; width: 263px;"><img alt="Your shopping cart is empty" src="/images/it_is_empty.gif" width="263" height="301"></span>

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
                                    <td><?= Html::encode(Yii::$app->user->isGuest ? $item['book_title'] : $item->bookIsbn->book_title); ?></td>
                                    <td><?= Yii::$app->formatter->currencyCode . (Yii::$app->user->isGuest ? $item['book_price'] : $item->bookIsbn->book_price); ?></td>
                                    <td>
                                        <?php
                                        $bookIsbn = Yii::$app->user->isGuest ? $item['book_isbn'] : $item->bookIsbn->book_isbn;
                                        echo Html::a('Remove', ['site/remove-item', 'book_isbn' => $bookIsbn], ['class' => 'btn btn-danger']);
                                        ?>
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
                            <p>Total Price: <?= Yii::$app->formatter->asCurrency(array_reduce($cartItems, function ($carry, $item) {
                                                if (Yii::$app->user->isGuest) {
                                                    return $carry + $item['book_price'];
                                                } else {
                                                    return $carry + $item->bookIsbn->book_price;
                                                }
                                            }, 0)); ?></p>
                        </div>

                    </div>
                    <div class="text-center">
                        <?php
                        if (Yii::$app->user->isGuest) {
                            echo Html::a('Checkout as Guest', Url::to(['site/checkout']), ['class' => 'btn btn-primary']);
                        } else {
                            echo Html::a('Checkout', Url::to(['site/checkout']), ['class' => 'btn btn-primary']);
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>