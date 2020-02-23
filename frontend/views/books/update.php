<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $book common\models\Book */
/* @var $authors common\models\Author[] */

$this->title = 'Редактировать книгу: ' . $book->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $book->title, 'url' => ['view', 'id' => $book->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'authors' => $authors,
        'book' => $book,
    ]) ?>

</div>
