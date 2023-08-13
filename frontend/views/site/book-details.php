<?php

/**
 * @var common\models\Book $book
 * @var yii\web\View $this
 */

use yii\helpers\Html;

$this->title = $book->book_title;
?>

<div class="container" style="margin-top: 80px;">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
            <h1><?= Html::encode($book->book_title) ?></h1>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= $book->getImageUrl() ?>" alt="Book Image" class="img-fluid" width="220px">
                </div>
                <div class="col-md-8">
                    <p><strong>Author:</strong> <?= $book->book_author ?></p>
                    <p><strong>ISBN:</strong> <?= $book->book_isbn ?></p>
                    <p><strong>Description:</strong> <?= $book->book_descr ?></p>
                    <p><strong>Price:</strong> <?=Yii::$app->formatter->currencyCode . $book->book_price ?></p>

                    <!-- Other book details here -->
                    <?= Html::a('Add to Cart', ['site/add-to-cart', 'book_isbn' => $book->book_isbn], ['class' => 'btn btn-black mr-1 rounded-0']) ?>

                </div>
            </div>
        </div>
    </div>
</div>