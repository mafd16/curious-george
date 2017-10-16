<?php

namespace Mafd16\Question;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Mafd16\Comment\Comments;

/**
 * Comment system.
 */
class QuestionModel implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;

    /**
     * @var array $session inject a reference to the session.
     */
    //private $session;



    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "commentsystem";



    /**
     * Inject dependencies.
     *
     * @param array $dependency key/value array with dependencies.
     *
     * @return self
     */
    //public function inject($dependency)
    //{
    //    $this->session = $dependency;
    //    return $this;
    //}


    /**
     * Save a question to a dataset.
     *
     * @param object    $question Object with values from asked question
     *                            (userId, title, question)
     *
     * @return void
     */
    public function saveQuestion($question)
    {
        // Connect to db
        $que = new Questions();
        $que->setDb($this->di->get("db"));

        // Set values
        $que->userId = $question->userId;
        $que->title = $question->title;
        $que->question = $question->question;
        $que->tag1Id = $question->tag1Id;
        $que->tag2Id = $question->tag2Id;
        $que->tag3Id = $question->tag3Id;
        $que->created = date("Y-m-d H:i:s");

        // Save
        $que->save();
    }


    /**
     * Get ALL comments from session
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @param string $key for data subset.
     *
     * @return object with the dataset
     */
    public function getComments()
    {
        // Using db as storage:
        // Get users from db
        $com = new Comments();
        $com->setDb($this->di->get("db"));
        $comments = $com->findAll();

        return $comments;
    }


    /**
     * Get ONE comment from session
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @param string $key for dataset.
     * @param int    $id for comment.
     *
     * @return array with the comment, name, email, id, or null if not exists
     */
    public function getComment($id)
    {
        // Using db
        $comments = $this->getComments();
        // Get comment with id $id
        $comment = null;
        foreach ($comments as $val) {
            if ($id == $val->id) {
                $comment = $val;
                break;
            }
        }
        return $comment;
    }


    /**
     * Add a comment to a dataset.
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @param array     $post   variables from posted comment
     *                          (article, name, email, comment)
     *
     * @return void
     */
    public function addComment($post)
    {
        // Connect to db
        $com = new Comments();
        $com->setDb($this->di->get("db"));

        $com->UserId = $post["id"];
        $com->UserName = $post["name"];
        $com->UserEmail = $post["email"];
        $com->comment = $post["comment"];

        $com->save();
    }


    /**
     * Update old comment with new comment
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @param int       $id         id for comment
     * @param array     $comment    the comment-array (name, email, comment, id)
     *
     * @return void
     */
    public function updateComment($id, $comment)
    {
        // Connect to db
        $com = new Comments();
        $com->setDb($this->di->get("db"));
        // Get comment
        $com->find("id", $id);
        // Update comment
        $com->comment = $comment["comment"];
        // Save
        $com->save();
    }


    /**
     * Delete comment with key and id
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @param int    $id            to delete
     *
     * @return void
     */
    public function deleteComment($id)
    {
        // Set default timezone
        date_default_timezone_set('Europe/Stockholm');
        // Connect to db
        $com = new Comments();
        $com->setDb($this->di->get("db"));
        // Get comment
        $com->find("id", $id);
        // Delete (Update) comment
        $com->deleted = date("Y-m-d H:i:s");
        // Save
        $com->save();
    }
}
