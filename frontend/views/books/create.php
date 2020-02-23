<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $book common\models\Book */
/* @var $authors common\models\Author[] */

$this->title = 'Добавить книгу';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'book' => $book,
        'authors' => $authors,
    ]) ?>

</div>
