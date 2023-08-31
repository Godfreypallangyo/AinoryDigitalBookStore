<?php
/**
 * @var common\models\Book $model
 */
namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\Html;

$book_no = 0;
?>
<style>
    /* Add these CSS styles to your existing stylesheets */
    .book-image {
        max-width: 100%;
        height: auto;
    }

    .product-item-2 {
        border: 1px solid #f0f0f0;
        border-radius: 4px;
        padding: 20px;
    }

    .product-details {
        display: flex;
        align-items: flex-start;
    }

    .product-info {
        flex: 3;
    }

    .product-actions {
        flex: 1;
        text-align: right;
        align-self: flex-end;
    }

    .product-actions a.btn {
        padding: 10px 20px;
        font-size: 14px;
        letter-spacing: 1px;
        border-radius: 0;
        margin-top: 10px;
    }

    .price {
        font-size: 18px;
        color: #e74c3c;
    }

    .number {
        background-color: #e74c3c;
        color: white;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 3px;
        display: inline-block;
        margin-bottom: 10px;
    }

    /* Media query for responsive design */
    @media (max-width: 767px) {
        .product-details {
            flex-direction: column;
            align-items: stretch;
        }

        .product-actions {
            text-align: left;
            align-self: flex-start;
            margin-top: 10px;
        }
    }

</style>
<div class="bg-white py-4 mb-4">
    <div class="row mx-4 my-4 product-item-2 align-items-start">
        <div class="col-md-3 mb-5 mb-md-0">
            <img src="<?php echo $model->getImageUrl() ?>" alt="Image" class="img-fluid book-image">
        </div>
        <div class="col-md-9 product-details">
            <div class="product-info">
                <span class="number">New</span>
                <h2 class="text-black mb-4 font-weight-bold"><?php echo $model->book_title ?></h2>
                <p class="mb-4"><?php echo StringHelper::truncateWords(strip_tags($model->book_descr), 30); ?></p>
                <div class="mb-4">
                    <h3 class="text-black font-weight-bold h5">Price:</h3>
                    <div class="price"><?php echo Yii::$app->formatter->currencyCode . $model->book_price ?></div>
                    <p class="my-5">
                        <a href="<?= Url::to(['site/book-details', 'isbn' => $model->book_isbn]) ?>"
                            class="btn btn-black btn-outline-black rounded-0 d-block mb-2 mb-lg-0 d-lg-inline-block">View
                            Details</a>
                        <?= Html::a('Add to Cart', ['site/add-to-cart', 'book_isbn' => $model->book_isbn], ['class' => 'btn btn-black mr-1 rounded-0']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>