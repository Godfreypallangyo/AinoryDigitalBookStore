<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OrderedBook $model */

$this->title = 'Create Ordered Book';
$this->params['breadcrumbs'][] = ['label' => 'Ordered Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordered-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
