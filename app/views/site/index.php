<?php

/** @var yii\web\View $this */

/** @var yii\data\ActiveDataProvider $dataProvider */

use app\models\Product;
use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin() ? Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => fn($item) => Html::img("../" . $item->image, ['size' => '300px'])
            ],
            'name',
            'price',
            //'country',
            //'year',
            //'model',
            [
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin(),
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],

        ],
    ]); ?>


</div>
