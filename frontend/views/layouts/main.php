<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md  navbar-dark bg-dark fixed-top ',
        ],
    ]);
    $menuItems = [
        ['label' => '<i class="fa fa-home" aria-hidden="true"></i> Home', 'url' => ['/site/index'],'encode'=>false],
        ['label' => '<i class="fa fa-pencil" aria-hidden="true"></i> About', 'url' => ['/site/about'],'encode'=>false],
        ['label' => '<i class="fa fa-book" aria-hidden="true"></i> Books', 'url' => ['/site/books'],'encode' => false],
        ['label' => '<i class="fa fa-phone" aria-hidden="true"></i> Contact', 'url' => ['/site/contact'],'encode' => false],
        ['label' => '<i class="fas fa-shopping-cart"></i> Cart', 'url' => ['/site/cart'], 'encode' => false],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="site-wrap" style="margin-top: 30px">
        <?= $content ?>
        </div>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
<footer class="site-footer bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2 class="footer-heading mb-4">About Us</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere laudantium magnam voluptatum autem. Amet aliquid nesciunt veritatis aliquam.</p>
                                </div>
                                <div class="col-md-3 ">
                                    <h2 class="footer-heading mb-4">Quick Links</h2>
                                    <ul class="list-unstyled">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Services</a></li>
                                        <li><a href="#">Testimonials</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h2 class="footer-heading mb-4">Follow Us</h2>
                                    <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                                    <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                                    <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                                    <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <h2 class="footer-heading mb-4">Featured Product</h2>
                            <a href="#"><img src="/images/product_1_bg.jpg" alt="Image" class="img-fluid mb-3"></a>
                            <h4 class="h5">Leather Brown Shoe</h4>
                            <strong class="text-black mb-3 d-inline-block">$60.00</strong>
                            <p><a href="#" class="btn btn-black rounded-0">Add to Cart</a></p>
                        </div>
                    </div>
                    <div class="row pt-5 mt-5 text-center">
                        <div class="col-md-12">
                            <div class="border-top pt-5">
                                <p>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
