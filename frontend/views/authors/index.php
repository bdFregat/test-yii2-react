<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить автора', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'birth_year',
            'rating',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{books} {view} {update} {delete}',
                'buttons' => [
                    'books' => function ($url, $author, $key) {


                        $icon = Html::a(
                            '',
                            '#',
                            [
                                'class' => 'glyphicon  glyphicon-book',
                                'data' => [
                                    'author-modal' => true,
                                    'author-id' => $author->id,
                                    'action' => Url::to(['books'])
                                ]
                            ]
                        );
                        return $icon;
                    }
                ]
            ],
        ],
    ]); ?>

    <?
    Modal::begin(['id' => "author-books"]);
    echo '<img src="/img/preloader.gif" alt="">';
    Modal::end();
    ?>
    <?php Pjax::end(); ?>

</div>
