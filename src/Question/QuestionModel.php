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
     * Get ALL questions from db
     *
     * @return object with the dataset
     */
    public function getQuestions()
    {
        // Connect to db
        $que = new Questions();
        $que->setDb($this->di->get("db"));
        // Get questions from db
        $questions = $que->findAll();

        return $questions;
    }


    /**
     * Get ONE question from db
     *
     * @param string $key   The key of the question
     * @param mixed  $value The value of the key
     *
     * @return object with the question
     */
    public function getQuestion($key, $value)
    {
        // Connect to db
        $que = new Questions();
        $que->setDb($this->di->get("db"));
        // Get question from db
        $question = $que->find($key, $value);
        return $question;
    }


    /**
     * Get questions with an restriction
     *
     * @param string    $key The key of the question
     * @param mixed     $value The value of the key
     *
     * @return array    $res Array with question-objects
     */
    public function getQuestionsWhere($key, $value)
    {
        // Connect to db
        $que = new Questions();
        $que->setDb($this->di->get("db"));
        // Find all matching questions
        $res = $que->findAllWhere("$key = ?", $value);
        return $res;
    }


    /**
     * Get all questions with a specific tag
     *
     * @param int       $tag The id of the tag
     *
     * @return array    $res Array with question-objects
     */
    public function getQuestionsWithTag($tag)
    {
        // Connect to db
        $que = new Questions();
        $que->setDb($this->di->get("db"));
        // Find all matching questions
        $res = $que->findAllWhere("tag1Id = ? OR tag2Id = ? OR tag3Id = ?", [$tag, $tag, $tag]);
        return $res;
    }


    /**
     * Get all questions answered by a user. Should work with comments aswell!
     *
     * @param array     $answers Array with the answer-objects with userId == $user->id
     *
     * @return array    $res Array with question-objects
     */
    public function getQuestionsAnsweredByUser($answers)
    {
        $ansQue = array();
        foreach ($answers as $answer) {
            $temp = $this->getQuestion("id", $answer->questionId);
            $ansQue[$temp->id] = $temp;
        };
        $res = $ansQue;
        return $res;
    }


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
        $que->rank = 0;
        $que->created = date("Y-m-d H:i:s");

        // Save
        $que->save();
    }


    /**
     * Vote plus one for question.
     *
     * @param int    $id The question id.
     *
     * @return object The question object
     */
    public function votePlusOne($id)
    {
        // Connect to db
        $que = new Questions();
        $que->setDb($this->di->get("db"));
        // Get the question
        $que->find("id", $id);
        // Add one
        $que->rank += 1;
        // Save
        $que->save();
        return $que;
    }


    /**
     * Vote minus one for question.
     *
     * @param int    $id The question id.
     *
     * @return object The question object
     */
    public function voteMinusOne($id)
    {
        // Connect to db
        $que = new Questions();
        $que->setDb($this->di->get("db"));
        // Get the question
        $que->find("id", $id);
        // Minus one
        $que->rank -= 1;
        // Save
        $que->save();
        return $que;
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
