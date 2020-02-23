<?php

namespace common\models\query;

use yii\db\ActiveQuery;

class AuthorQuery extends ActiveQuery
{

    public function id($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    public function orderByRating($direction = SORT_DESC)
    {
        return $this->orderBy(['rating' => $direction]);
    }

    public function orderByName($direction = SORT_DESC)
    {
        return $this->orderBy(['name' => $direction]);
    }

    public function joinWithBooks()
    {
        return $this->joinWith('books');
    }

    public function withBooksCount()
    {
        return $this->joinWithBooks()
            ->addSelect('authors.*')
            ->addSelect('COUNT(books.id) AS books_count')
            ->groupBy('authors.id');
    }
}