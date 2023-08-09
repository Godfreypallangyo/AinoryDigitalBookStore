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

$book_no=0;
?>
  <div class="bg-white py-4 mb-4">
                        <div class="row mx-4 my-4 product-item-2 align-items-start">
                            <div class="col-md-6 mb-5 mb-md-0">
                                <img src="<?php echo $model->getImageUrl()?>" alt="Image" class="img-fluid">
                            </div>
                            <div class="col-md-5 ml-auto product-title-wrap">
                                <span class="number">New</span>
                                <h3 class="text-black mb-4 font-weight-bold"><?php echo $model->book_title ?></h3>
                                <p class="mb-4"><?php echo StringHelper::truncateWords(strip_tags($model->book_descr),30);?></p>

                                <div class="mb-4">
                                    <h3 class="text-black font-weight-bold h5">Price:</h3>
                                    <div class="price"><?php echo Yii::$app->formatter->currencyCode . $model->book_price?></div>
                                </div>
                                <p>
                                    <a href="#" class="btn btn-black btn-outline-black rounded-0 d-block mb-2 mb-lg-0 d-lg-inline-block">View Details</a>
                                    <?= Html::a('Add to Cart', ['site/add-to-cart', 'book_isbn' => $model->book_isbn], ['class' => 'btn btn-black mr-1 rounded-0']) ?>
                                    </p>
                            </div>
                        </div>
                    </div>