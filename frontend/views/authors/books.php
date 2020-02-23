<?php

/** @var \common\models\Book[] $books */
/** @var \common\models\Author $author */

/* @var $this yii\web\View */

use yii\helpers\Html;

?>

    <h2><?= "Список книг автора $author->name" ?></h2>
<? if (empty($books)) { ?>
    <p>Автор пока не добавил ни одной книги</p>
<? } else { ?>
    <ul>
        <? foreach ($books as $book) { ?>
            <li><?= Html::a("$book->title, $book->publication_year г.", ['/books/view', 'id' => $book->id]) ?></li>
        <? } ?>
    </ul>
<? } ?>