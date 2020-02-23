<?php

namespace common\models\query;

use yii\db\ActiveQuery;

class BookQuery extends ActiveQuery
{

    public function id($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    public function author($id)
    {
        return $this->andWhere(['author_id' => $id]);
    }

    public function orderByYear($direction = SORT_DESC)
    {
        return $this->orderBy(['publication_year' => $direction]);
    }

    public function orderByRating($direction = SORT_DESC)
    {
        return $this->orderBy(['rating' => $direction]);
    }
}