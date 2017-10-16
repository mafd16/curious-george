<?php

namespace Mafd16\Tag;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Mafd16\Comment\Comments;

/**
 * Comment system.
 */
class TagModel implements
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
     * Check if tag exists
     *
     * @param string    $tagToCheck The tag
     *
     * @return boolean  true or false
     */
    public function doTagExist($tagToCheck)
    {
        // Connect to db
        $tag = new Tags();
        $tag->setDb($this->di->get("db"));
        // Look for tag
        $tag->find("tag", $tagToCheck);
        if ($tag->tag) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Get tag id
     *
     * @param string    $tagToCheck The tag
     *
     * @return int      tag id
     */
    public function getTagId($tagToCheck)
    {
        // Connect to db
        $tag = new Tags();
        $tag->setDb($this->di->get("db"));
        // Look for tag
        $tag->find("tag", $tagToCheck);
        return $tag->id;
    }


    /**
     * Save tag
     *
     * @param string    $tagToSave The tag
     *
     * @return int      tag id
     */
    public function saveTag($tagToSave)
    {
        // Connect to db
        $tag = new Tags();
        $tag->setDb($this->di->get("db"));
        // save tag
        $tag->tag = $tagToSave;
        $tag->save();
        return $tag->id;
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
