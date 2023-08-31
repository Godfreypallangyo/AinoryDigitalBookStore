<?php
/**
 * @var common\models\Book $book
 * @var yii\web\View $this
 */

use yii\helpers\Html;

$this->title = $book->book_title;
?>
<style>
    /* Add these CSS styles to your existing stylesheets */
.book-image {
    max-width: 100%;
    height: auto;
}

.book-details {
    border: 1px solid #f0f0f0;
    border-radius: 4px;
    padding: 20px;
}

.book-info {
    padding-right: 20px;
}

.book-descr {
    margin-top: 0;
}

.book-actions {
    margin-top: 20px;
}

.book-actions a.btn {
    padding: 10px 20px;
    font-size: 14px;
    letter-spacing: 1px;
    border-radius: 0;
    margin-right: 10px;
}

/* Media query for responsive design */
@media (max-width: 767px) {
    .book-details {
        padding: 20px 10px;
    }

    .book-details .row {
        flex-direction: column-reverse;
    }

    .book-info,
    .book-actions {
        padding: 0;
        margin-top: 10px;
    }

    .book-actions {
        text-align: center;
    }
}

</style>
<div class="container" style="margin-top: 80px;">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
            <h1><?= Html::encode($book->book_title) ?></h1>
            <div class="row book-details">
                <div class="col-md-4">
                    <img src="<?= $book->getImageUrl() ?>" alt="Book Image" class="img-fluid book-image">
                </div>
                <div class="col-md-8">
                    <div class="book-info">
                        <p><strong>Author:</strong> <?= $book->book_author ?></p>
                        <p><strong>ISBN:</strong> <?= $book->book_isbn ?></p>
                        <p><strong>Description:</strong></p>
                        <p class="book-descr"><?= $book->book_descr ?></p>
                        <p><strong>Price:</strong> <?= Yii::$app->formatter->currencyCode . $book->book_price ?></p>
                    </div>
                    <div class="book-actions">
                        <?= Html::a('Add to Cart', ['site/add-to-cart', 'book_isbn' => $book->book_isbn], ['class' => 'btn btn-black mr-1 rounded-0']) ?>
                        <!-- <?php if ($book->book_file) : ?>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/site/download', 'file' => $book->book_file]) ?>" class="btn btn-primary">Download Book</a>
                        <?php endif; ?> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
