<?php

namespace Mafd16\Tag;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Tags extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tags";


    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $tag;
    public $rank;
}
