<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $author common\models\Author */

$this->title = 'Редактировать автора: ' . $author->name;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $author->name, 'url' => ['view', 'id' => $author->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'author' => $author,
    ]) ?>

</div>
