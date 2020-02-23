<?php

namespace frontend\controllers;

use common\models\Book;
use Yii;
use common\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthorsController implements the CRUD actions for Author author.
 */
class AuthorsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Authors.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Author::find(),
            'sort' => ['defaultOrder' => ['rating' => SORT_DESC]]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Author.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the author cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'author' => $this->findAuthor($id),
        ]);
    }

    /**
     * Creates a new Author.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $author = new Author();

        if ($author->load(Yii::$app->request->post()) && $author->save()) {
            return $this->redirect(['view', 'id' => $author->id]);
        }

        return $this->render('create', [
            'author' => $author,
        ]);
    }

    /**
     * Updates an existing Author.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the author cannot be found
     */
    public function actionUpdate($id)
    {
        $author = $this->findAuthor($id);

        if ($author->load(Yii::$app->request->post()) && $author->save()) {
            return $this->redirect(['view', 'id' => $author->id]);
        }

        return $this->render('update', [
            'author' => $author,
        ]);
    }

    /**
     * Deletes an existing Author.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the author cannot be found
     */
    public function actionDelete($id)
    {
        $author = $this->findAuthor($id);

        try {
            $author->delete();
        } catch (\Throwable $exception) {
            Yii::$app->session->setFlash('error', 'Невозможно удалить автора. Возможно у него есть книги.');
            return $this->redirect(['/authors/view', 'id' => $author->id]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Author author based on its primary key value.
     * If the author is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Author the loaded author
     * @throws NotFoundHttpException if the author cannot be found
     */
    protected function findAuthor($id)
    {
        if (($author = Author::findOne($id)) !== null) {
            return $author;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBooks()
    {
        $author = $this->findAuthor(Yii::$app->request->get('author-id'));
        $books = Book::find()
            ->author($author->id)
            ->orderByYear(SORT_ASC)
            ->all();

        return $this->renderAjax('books', [
            'author' => $author,
            'books' => $books
        ]);
    }
}
