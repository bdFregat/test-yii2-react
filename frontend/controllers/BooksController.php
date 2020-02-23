<?php

namespace frontend\controllers;

use Yii;
use common\models\Author;
use common\models\Book;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BooksController implements the CRUD actions for Book book.
 */
class BooksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book books.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find(),
            'sort' => ['defaultOrder' => ['rating' => SORT_DESC]]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'authors' => $this->prepareAuthorsList(),
        ]);
    }

    /**
     * Displays a single Book.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the book cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'book' => $this->findBook($id),
        ]);
    }

    /**
     * Creates a new Book.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $book = new Book();

        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(['view', 'id' => $book->id]);
        }

        return $this->render('create', [
            'book' => $book,
            'authors' => $this->prepareAuthorsList(),
        ]);
    }

    /**
     * Updates an existing Book.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the book cannot be found
     */
    public function actionUpdate($id)
    {
        $book = $this->findBook($id);

        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(['view', 'id' => $book->id]);
        }

        return $this->render('update', [
            'book' => $book,
            'authors' => $this->prepareAuthorsList(),
        ]);
    }

    /**
     * Deletes an existing Book.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the book cannot be found
     */
    public function actionDelete($id)
    {
        $this->findBook($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book book based on its primary key value.
     * If the book is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded book
     * @throws NotFoundHttpException if the book cannot be found
     */
    protected function findBook($id)
    {
        if (($book = Book::findOne($id)) !== null) {
            return $book;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function prepareAuthorsList()
    {
        $authors = Author::find()
            ->select(['name', 'id'])
            ->orderByName(SORT_ASC)
            ->asArray()
            ->all();
        if (empty($authors)) {
            Yii::$app->session->setFlash('warning', 'Добавьте хотя бы одного автора перед тем, как добавить книгу.');
            return $this->redirect(['/authors']);
        }
        return array_column($authors, 'name', 'id');
    }
}
