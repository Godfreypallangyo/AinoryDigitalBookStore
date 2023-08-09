<?php

/** @var yii\web\View $this */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = 'Ainory Digital Book Store';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="site-wrap">
            <div class="site-blocks-cover overlay" style="background-image:url('/images/hero_2.jpg')" data-aos="fade" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">

                            <div class="row mb-4">
                                <div class="col-md-7">
                                    <h1>Ainory Peter Gesase</h1>
                                    <p class="mb-5 lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam assumenda ea quo cupiditate facere deleniti fuga officia.</p>
                                    <div>
                                        <a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 mb-lg-0 mb-2 d-block d-sm-inline-block">Shop Now</a>
                                        <a href="#" class="btn btn-white py-3 px-5 rounded-0 d-block d-sm-inline-block">Club Membership</a>
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
                            <img src="/images/about_1.jpg" class="img-fluid" alt="Image">
                            <div class="experience">
                                <span class="year">Trusted Merchant</span>
                                <span class="caption">for 50 years</span>
                            </div>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <h3 class="section-sub-title">Merchant Company</h3>
                            <h2 class="section-title mb-3">About Us</h2>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui fuga ipsa, repellat blanditiis nihil, consectetur. Consequuntur eum inventore, rem maxime, nisi excepturi ipsam libero ratione adipisci alias eius vero vel!</p>
                            <p><a href="#" class="btn btn-black btn-black--hover rounded-0">Learn More</a></p>
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