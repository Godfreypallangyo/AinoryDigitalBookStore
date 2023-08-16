<?php

/** @var yii\web\View $this */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = 'Ainory Digital Book Store';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="site-wrap">
            <div class="site-blocks-cover overlay" style="background-image:url('/images/WelcomePicture.jpg')" data-aos="fade" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                            <?php if (Yii::$app->session->hasFlash('success')) : ?>
                                <div class="alert alert-success">
                                    <?= Yii::$app->session->getFlash('success') ?>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-4">
                                <div class="col-md-7">
                                    <h1>Ainory Peter Gesase</h1>
                                    <p class="mb-5 lead">Ainory Gesase stands as a luminary in the realm of authors and anatomists,
                                        an individual whose words transcend the ordinary,
                                        venturing into the extraordinary. With a keen intellect that navigates both the realms
                                        of professional excellence and spiritual depth, Ainory Gesase crafts a symphony of words
                                        that resonates with readers across boundaries.</p>
                                    <div>
                                        <?= Html::a('Author Biography', ['site/author-bio'], ['class' => 'btn btn-white py-3 px-5 rounded-0 d-block d-sm-inline-block']) ?>
                                        <!-- <a href="#" class="btn btn-white py-3 px-5 rounded-0 d-block d-sm-inline-block">Club Membership</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-section bg-light">
                <div class="container">
                    <div class="row mb-5 justify-content-center">
                        <div class="col-md-6 text-center">
                            <h3 class="section-sub-title">Awesome Books</h3>
                            <h2 class="section-title mb-3">Three Latest Books</h2>
                            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae nostrum natus excepturi fuga ullam accusantium vel ut eveniet aut consequatur laboriosam ipsam.</p> -->
                        </div>
                    </div>
                    <?php echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_book_item'
                    ]) ?>
                </div>
            </div>


            <div class="site-section" id="about-section">
                <div class="container">
                    <div class="row align-items-lg-center">
                        <div class="col-md-8 mb-5 mb-lg-0 position-relative">
                            <img src="/images/Library.jpeg" class="img-fluid" alt="Image">

                        </div>
                        <div class="col-md-3 ml-auto">
                            <h3 class="section-sub-title">Digital Book Store</h3>
                            <h2 class="section-title mb-3">About Us</h2>
                            <p class="mb-4">Ainory Peter Gesase is the author of the four books that focuses on spiritual issues key to people salvation. He failed to raise funds to get the books published and and to access self-publishing printing companies.</p>
                            <!-- <p><a href="#" class="btn btn-black btn-black--hover rounded-0">Learn More</a></p> -->
                            <?= Html::a('Read More', Url::to(['site/about']), ['class' => 'btn btn-black btn-black--hover rounded-0']) ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>





</div>
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/jquery-migrate-3.0.1.min.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/jquery.stellar.min.js"></script>
<script src="/js/jquery.countdown.min.js"></script>
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/aos.js"></script>
<script src="/js/jquery.fancybox.min.js"></script>
<script src="/js/jquery.sticky.js"></script>


<script src="js/main.js"></script>
</div>