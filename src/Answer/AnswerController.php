<?php

namespace Mafd16\Answer;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\TextFilter\TextFilter;

/**
 * A controller for the Comment System.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
//class CommentController implements AppInjectableInterface
class AnswerController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * Save the answer.
     *
     * @return void
     */
    public function saveAnswer()
    {
        // Get post-variables
        $post = $this->di->get("request")->getPost();

        // Filter text to markdown
        $filter = new TextFilter();
        $text = $filter->parse($post["answer"], ["markdown"]);

        // Create answer object
        $answer = (object) [
            "questionId" => $post["questionId"],
            "userId" => $post["userId"],
            "answer" => $text->text,//$post["answer"],
        ];

        // Instruct Model to save answer:
        $this->di->get("answerModel")->saveAnswer($answer);

        // Instruct userModel to add one entry to user
        $this->di->get("user")->addOneEntry($post["userId"]);

        // Redirect back to the question page:
        $url = $this->di->get("url")->create("questions/$post[questionId]");
        $this->di->get("response")->redirect($url);
    }


    /**
     * Accept the answer.
     *
     * @return void
     */
    public function acceptAnswer($id)
    {
        // Instruct Model to accept answer:
        $answer = $this->di->get("answerModel")->acceptAnswer($id);
        // Redirect back to the question page:
        $url = $this->di->get("url")->create("questions/$answer->questionId");
        $this->di->get("response")->redirect($url);
    }


    /**
     * Vote plus one for answer.
     *
     * @return void
     */
    public function votePlusOne($id)
    {
        // Instruct Model to plus one:
        $answer = $this->di->get("answerModel")->votePlusOne($id);
        // Redirect back to the questions page:
        $url = $this->di->get("url")->create("questions/$answer->questionId");
        $this->di->get("response")->redirect($url);
    }


    /**
     * Vote minus one for answer.
     *
     * @return void
     */
    public function voteMinusOne($id)
    {
        // Instruct Model to minus one:
        $answer = $this->di->get("answerModel")->voteMinusOne($id);
        // Redirect back to the questions page:
        $url = $this->di->get("url")->create("questions/$answer->questionId");
        $this->di->get("response")->redirect($url);
    }




    /**
     * Get ALL comments from an article.
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @return void
     */
    public function getComments()
    {
        $key = "comPage";
        // Get comments from model
        $comments = $this->di->get("com")->getComments($key);
        // Add views to a specific region, add comments
        $this->di->get("view")->add("comment/index", ["comments"=>$comments], "main");
        // Render a standard page using layout
        $this->di->get("pageRender")->renderPage(["title" => "Kommentarssystem"]);
    }


    /**
     * Get ONE comment from an article.
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @param string $key for the article
     * @param int    $id for the comment id
     *
     * @return void
     */
    public function getComment($id)
    {
        $comment = $this->di->get("com")->getComment($id);
        return $comment;
    }


    /**
     * Get ONE comment for editing.
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @return void
     */
    public function getCommentToEdit()
    {
        $id = $this->di->get("request")->getGet("id");
        // Get the comment from Model.
        $comment = $this->di->get("com")->getComment($id);
        // Add views to a specific region
        $this->di->get("view")->add("comment/edit", ["comment"=>$comment], "main");
        // Render a standard page using layout
        $this->di->get("pageRender")->renderPage([
            "title" => "Redigera kommentar",
        ]);
    }


    /**
     * Edit a comment.
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @return void
     */
    public function editComment()
    {
        // Get post-variables
        $post = $this->di->get("request")->getPost();
        // Instruct Model to edit comment:
        // Edited comment:
        $comment = [
            "user_id" => $post["user_id"],
            "name" => $post["name"],
            "email" => $post["email"],
            "comment" => $post["comment"],
            "id" => $post["id"]
        ];
        $this->di->get("com")->updateComment($post["id"], $comment);
        // Send user back to comment page.
        $url = $this->di->get("url")->create("comment");
        $this->di->get("response")->redirect($url);
    }



    /**
     * Post a comment, with name and email.
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @return void
     */
    public function postComment()
    {
        // Catch post variables
        $post = $this->di->get("request")->getPost();
        // Instruct Model to add comment:
        $this->di->get("com")->addComment($post);
        // Send user back to comment page.
        $url = $this->di->get("url")->create("comment");
        $this->di->get("response")->redirect($url);
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
        $this->di->get("com")->updateComment($id, $comment);
    }


    /**
     * Delete comment with id
     * EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT! EDIT!
     *
     * @return void
     */
    public function deleteComment()
    {
        // Get id-variable from request.
        $id = $this->di->get("request")->getGet("id");
        // Instruct Model to delete comment:
        $this->di->get("com")->deleteComment($id);
        // Send user back to comment page.
        $url = $this->di->get("url")->create("comment");
        $this->di->get("response")->redirect($url);
    }
}
