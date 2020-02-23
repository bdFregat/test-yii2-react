<?php

use yii\db\Migration;

/**
 * Class m200220_191438_authors
 */
class m200220_191438_authors extends Migration
{
    /**
     * {@inheritdoc}
     * yii gii/model --color --tableName="authors" --modelClass="Author" --ns="common\models"
     * yii gii/crud --color  --controllerClass="backend\controllers\AuthorController" --enablePjax --modelClass="\common\models\Author" --viewPath="@backend/views/author"
     */
    public function safeUp()
    {
        $this->createTable('authors', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'birth_year' => $this->integer()->notNull(),
            'rating' => $this->float()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('authors');
    }
}
