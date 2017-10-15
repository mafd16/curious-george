<?php

namespace Mafd16\Comment;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Answers extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Answers";


    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $questionId;
    public $userId;
    public $answer;
    public $accepted;
    public $created;
    public $updated;
    public $deleted;
    public $rank;
}
