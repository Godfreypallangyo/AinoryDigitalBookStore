<?php
/**
 * @var common\models\Book $model
 */
namespace common\models;

use Yii;
use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\helpers\Url;


?>
<div class="product-item">
    <figure>
        <img src="<?php echo $model->getImageUrl()?>" alt="Image" class="img-fluid" width="220px">
    </figure>
    <div class="px-4">
        <h3><?php echo $model->book_title ?></h3>
        <div class="mb-3">
            <span class="meta-icons mr-3"><a href="#" class="mr-2"><span class="icon-star text-warning text-center"></span></a><?php echo Yii::$app->formatter->currencyCode ." ". $model->book_price?></span>
        </div>
        <p class="mb-4"><?php echo StringHelper::truncateWords(strip_tags($model->book_descr),30);?></p>
        <div>
        <?= Html::a('Add to Cart', ['site/add-to-cart', 'book_isbn' => $model->book_isbn], ['class' => 'btn btn-black mr-1 my-3 rounded-0']) ?>
        <?= Html::a( 'View details',['site/book-details', 'isbn' => $model->book_isbn],['class'=>"btn btn-black btn-outline-black rounded-0 d-block mb-2 mb-lg-0 d-lg-inline-block"])?>
        </div>
    </div>
</div>