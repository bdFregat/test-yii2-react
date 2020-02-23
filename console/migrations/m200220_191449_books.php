<?php

use yii\db\Migration;

/**
 * Class m200220_191449_books
 */
class m200220_191449_books extends Migration
{
    /**
     * {@inheritdoc}
     * yii gii/model --color --tableName="books" --modelClass="Book" --ns="common\models"
     * yii gii/crud --color  --controllerClass="backend\controllers\BookController" --enablePjax --modelClass="\common\models\Book" --viewPath="@backend/views/book"
     */
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'author_id' => $this->bigInteger()->unsigned()->notNull(),
            'title' => $this->string()->notNull(),
            'publication_year' => $this->integer()->notNull(),
            'rating' => $this->float()
        ]);
        $this->addForeignKey(
            'fk_books_authors',
            'books',
            'author_id',
            'authors',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_books_authors', 'books');
        $this->dropTable('books');
    }
}
