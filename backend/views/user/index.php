<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
        <div class="row">
            <div class="col-md-8">
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        // 'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            'status',
            'created_at:date',
            'updated_at:date',
            //'verification_token',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

            </div>
            <div class="col-md-4">
                <h2>Search User</h2>
            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

            </div>
        </div>
    
    
    <?php Pjax::end(); ?>

</div>
