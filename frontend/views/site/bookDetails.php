<?php
/**
 * @var common\models\Book $book
 * @var yii\web\View $this
 */
use yii\helpers\Html;

$this->title = $book->book_title;
?>

<div class="container">
    <h1><?= Html::encode($book->book_title) ?></h1>
    <div class="row">
        <div class="col-md-4">
            <img src="<?= $book->getImageUrl() ?>" alt="Book Image" class="img-fluid">
        </div>
        <div class="col-md-8">
            <p><strong>Author:</strong> <?= $book->book_author ?></p>
            <p><strong>Genre:</strong> <?= $book->book_genre ?></p>
            <p><strong>Published:</strong> <?= Yii::$app->formatter->asDate($book->book_published, 'long') ?></p>
            <p><strong>ISBN:</strong> <?= $book->book_isbn ?></p>
            <p><strong>Description:</strong> <?= $book->book_descr ?></p>
            <!-- Other book details here -->
        </div>
    </div>
</div>
