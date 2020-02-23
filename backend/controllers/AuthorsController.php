<?php

namespace backend\controllers;

use common\models\Author;
use yii\rest\Controller;

/**
 * Class AuthorsController
 * @package backend\controllers
 */
class AuthorsController extends Controller
{

    protected function verbs()
    {
        return [
            'index' => ['get']
        ];
    }

    /**
     * Список книг
     * @return array
     */
    public function actionIndex()
    {
        return Author::find()
            ->withBooksCount()
            ->asArray()
            ->all();
    }
}