<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $authors array */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'author_id',
                'value' => function ($book) use ($authors) {
                    return $authors[$book->author_id];
                }
            ],
            'title',
            'publication_year',
            'rating',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{author} {view} {update} {delete}',
                'buttons' => [
                    'author' => function ($url, $book, $key) {
                        $icon = Html::a(
                            '',
                            ['/authors/view', 'id' => $book->author_id],
                            ['class' => 'glyphicon  glyphicon-user']
                        );
                        return $icon;
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
