<?php

namespace Mafd16\Comment;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Questions extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Questions";


    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $question;
    public $tag1Id;
    public $tag2Id;
    public $tag3Id;
    public $created;
    public $updated;
    public $deleted;
    public $rank;
}
