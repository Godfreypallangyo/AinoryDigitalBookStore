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
<style>
    /* Add these CSS styles to your existing stylesheets */
.image-container {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.image-container img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease-in-out;
}

.image-container .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.image-container:hover img {
    transform: scale(1.1);
}

.image-container:hover .overlay {
    opacity: 1;
}

.content-container {
    padding: 40px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.section-title {
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
}

.mb-4 {
    font-size: 16px;
    line-height: 1.6;
}

.btn-black {
    background-color: #000;
    color: #fff;
    border-color: #000;
    transition: background-color 0.3s ease-in-out;
}

.btn-black:hover {
    background-color: #333;
}

.btn-black--hover {
    background-color: #333;
    color: #fff;
    border-color: #333;
}

</style>
<div class="site-index">
    <div class="body-content">
        <div class="site-wrap">
            <div class="container-fluid site-blocks-cover overlay" style="background-image:url('/images/WelcomePicture.jpg')" data-aos="fade" data-stellar-background-ratio="0.5">
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
            <div class="site-section bg-light mx-5">
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
                        'itemView' => '_book_item',
                        'summary' => '',
                    ]) ?>
                </div>
            </div>


            <div class="site-section" id="about-section">
    <div class="container">
        <div class="row align-items-lg-center">
            <div class="col-md-6 mb-5 mb-lg-0 position-relative">
                <div class="image-container">
                    <img src="/images/Library.jpeg" class="img-fluid" alt="Image">
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="content-container">
                    <h2 class="section-title mb-3">About Us</h2>
                    <p class="mb-4">Theologians, pastors and self-proclaimed prophets and apostles have produced a misleading interpretation of Bible prophecies putting Christians into a state of confusion. A good understanding about these prophecies enhances our faith in Jesus and in God’s word and as a result the pathway to salvation becomes more clearer. Among such prophecies include the 70 weeks’ prophecy; 2300 days’ prophecy; Revelation chapter 13 prophecy; 1335 days’ prophecy; 1290 days’ prophecy and a time, times and half a time prophecy. Also, people have given misleading views about Ezekiel’s temple, the abomination of desolation and the two Bible witnesses. Kindly read the four books and see how the Spirit interpret the issues above.</p>
                    <?= Html::a('Read More', Url::to(['site/about']), ['class' => 'btn btn-black btn-black--hover rounded-0']) ?>
                </div>
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