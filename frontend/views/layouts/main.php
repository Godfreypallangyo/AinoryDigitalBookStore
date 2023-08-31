<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\models\Cart;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
if (Yii::$app->user->isGuest) {
    // User is a guest, use session cart data
    $cartItems = Yii::$app->session->get('cartItems', []);
} else {
    // User is logged in, fetch cart data from the database
    $user = Yii::$app->user->identity;
    $cartItems = Cart::find()->where(['user_id' => $user->id])->with('bookIsbn')->all();
}
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
    <!-- <link rel="stylesheet" href="fonts/icomoon/style.css"> -->
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
        $totalItemsInCart = count($cartItems); // Calculate total items

        $cartLabel = '<i class="fas fa-shopping-cart"></i> Cart';
        if ($totalItemsInCart > 0) {
            $cartLabel .= ' <sup style="color:red;">' .'<b>'. $totalItemsInCart . '</b>'. '</sup>';
        }

        $menuItems = [
            ['label' => '<i class="fa fa-home" aria-hidden="true"></i> Home', 'url' => ['/site/index'], 'encode' => false],
            ['label' => '<i class="fa fa-pencil" aria-hidden="true"></i> About', 'url' => ['/site/about'], 'encode' => false],
            ['label' => '<i class="fa fa-book" aria-hidden="true"></i> Books', 'url' => ['/site/books'], 'encode' => false],
            ['label' => '<i class="fa fa-phone" aria-hidden="true"></i> Contact', 'url' => ['/site/contact'], 'encode' => false],
            ['label' => $cartLabel, 'url' => ['/site/cart'], 'encode' => false],
        ];

        if (!Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '<i class="fas fa-account"></i> Profile <sup style="color:red;"></sup>', 'url' => ['/site/profile'], 'encode' => false];
        } else {
            // Add login and signup links for guests
            // $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
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
        <div class="container-fluid">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

<!-- Footer -->
<footer class="sticky-footer bg-white" style="margin-top: 50px;">
    <div class="container my-auto">
        <div class="row justify-content-center">
            <!-- Social Media Links -->
            <div class="col-auto">
                <a class="btn btn-social-icon btn-facebook" href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>
            <div class="col-auto">
                <a class="btn btn-social-icon btn-twitter" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
            <div class="col-auto">
                <a class="btn btn-social-icon btn-linkedin" href="#">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <div class="col-auto">
                <a class="btn btn-social-icon btn-instagram" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
        <div class="text-center my-2">
            <span>Copyright &copy; <?php echo Yii::$app->name?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->



    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
