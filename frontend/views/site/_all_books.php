<?php
/**
 * @var common\models\Book $model
 */
namespace common\models;
use yii\helpers\StringHelper;
use yii\helpers\Html;


?>
<div class="product-item">
    <figure>
        <img src="<?php echo $model->getImageUrl()?>" alt="Image" class="img-fluid">
    </figure>
    <div class="px-4">
        <h3><?php echo $model->book_title ?></h3>
        <div class="mb-3">
            <span class="meta-icons mr-3"><a href="#" class="mr-2"><span class="icon-star text-warning"></span></a> 5.0</span>
            <span class="meta-icons wishlist"><a href="#" class="mr-2"><span class="icon-heart"></span></a> 29</span>
        </div>
        <p class="mb-4"><?php echo StringHelper::truncateWords(strip_tags($model->book_descr),30);?></p>
        <div>
        <?= Html::a('Add to Cart', ['site/add-to-cart', 'book_isbn' => $model->book_isbn], ['class' => 'btn btn-black mr-1 rounded-0']) ?>
            <a href="#" class="btn btn-black btn-outline-black ml-1 rounded-0">View</a>
        </div>
    </div>
</div>