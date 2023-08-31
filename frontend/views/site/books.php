<?php
$this->title = 'Full Catalog of Books';
// $this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap5\LinkPager;
use yii\grid\GridView;
use yii\widgets\ListView;
?>
<div class="site-books">

  <div class="site-section" id="products-section">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-6 text-center">
          <h3 class="section-sub-title">Full Catalog Of Books</h3>
        </div>
      </div>

   
        <div class="col-md-12"  data-aos="fade-up" data-aos-delay="400">
          <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            // 'layout'=>'{summary}\<div class="row">{items}</div>\n{pager}',
            'itemView' => '_all_books',
            'options'=>['class'=>'row my-5'],
            'itemOptions' => ['class' => 'col-md-6 col-lg-4 mb-4 mb-lg-4'],
            'pager' => [
              'class' => \yii\bootstrap5\LinkPager::class,
              'hideOnSinglePage' => true, // Hide pagination if there's only one page
              'options' => ['class' => 'pagination justify-content-center'], // Customize the pagination container's class
              'prevPageLabel' => '< Previous', // Customize the "Previous" button label
              'nextPageLabel' => 'Next >', // Customize the "Next" button label
              // ... other pager options
          ],
          ]) ?>
        </div>

      <div class="site-section" id="blog-section">
        <div class="container">
          <div class="row mb-5">
            <div class="col-12 text-center">
              <h3 class="section-sub-title">Other Publications</h3>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
              <div class="h-entry">
                <img src="/images/model_1_bg.jpg" alt="Image" class="img-fluid">
                <h2 class="font-size-regular"><a href="#" class="text-black">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h2>
                <div class="meta mb-4">Ham Brook <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eligendi nobis ea maiores sapiente veritatis reprehenderit suscipit quaerat rerum voluptatibus a eius.</p>
                <p><a href="#">Continue Reading...</a></p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
              <div class="h-entry">
                <img src="/images/product_1_bg.jpg" alt="Image" class="img-fluid">
                <h2 class="font-size-regular"><a href="#" class="text-black">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h2>
                <div class="meta mb-4">James Phelps <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eligendi nobis ea maiores sapiente veritatis reprehenderit suscipit quaerat rerum voluptatibus a eius.</p>
                <p><a href="#">Continue Reading...</a></p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
              <div class="h-entry">
                <img src="/images/model_5_bg.jpg" alt="Image" class="img-fluid">
                <h2 class="font-size-regular"><a href="#" class="text-black">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h2>
                <div class="meta mb-4">James Phelps <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eligendi nobis ea maiores sapiente veritatis reprehenderit suscipit quaerat rerum voluptatibus a eius.</p>
                <p><a href="#">Continue Reading...</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>