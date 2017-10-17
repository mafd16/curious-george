<?php

namespace Mafd16\Question;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\TextFilter\TextFilter;

/**
 * A controller for the Comment System.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
//class CommentController implements AppInjectableInterface
class QuestionController implements InjectionAwareInterface
{
    use InjectionAwareTrait;


    /**
     * Show the ask question page.
     *
     * @return void
     */
    public function askQuestion()
    {
        $title      = "Ask a question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get all the tags
        $tags =  $this->di->get("tagModel")->getAllTags();

        $data = [
            //"items" => $book->findAll(),
            //"tags" => $this->di->get("tagModel")->getAllTags(),
            "tags" => $tags,
        ];

        $view->add("pages/questions/ask", $data);
        //$view->add("blocks/footer", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Save the asked question.
     *
     * @return void
     */
    public function saveQuestion()
    {
        // Get post-variables
        $post = $this->di->get("request")->getPost();

        // Save new or existing tags and get tag-id:
        $tags = [
            isset($post["tag1"]) ? $post["tag1"] : null,
            isset($post["tag2"]) ? $post["tag2"] : null,
            isset($post["tag3"]) ? $post["tag3"] : null,
        ];
        $tagId = $this->di->get("tagController")->saveTagsAndGetTagId($tags);

        // Filter text to markdown
        $filter = new TextFilter();
        $text = $filter->parse($post["question"], ["markdown"]);

        // Create question object
        $question = (object) [
            "userId" => $post["userId"],
            "title" => $post["title"],
            "question" => $text->text,//$post["question"],
            "tag1Id" => $tagId[0],
            "tag2Id" => $tagId[1],
            "tag3Id" => $tagId[2],
        ];

        // Instruct Model to save question:
        $this->di->get("questionModel")->saveQuestion($question);

        // Redirect back to the questions page:
        $url = $this->di->get("url")->create("questions");
        $this->di->get("response")->redirect($url);
    }


    /**
     * Show one question.
     *
     * @param int $id The id of the question
     *
     * @return void
     */
    public function showQuestion($id)
    {
        $title      = "Show question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get the question
        $question = $this->di->get("questionModel")->getQuestion("id", $id);

        // Get the answers
        $answers = $this->di->get("answerModel")->getAnswersWhere("questionId", $question->id);

        // Get the comments
        $comments = $this->di->get("com")->getCommentsWhere("questionId", $question->id);

        $data = [
            "question" => $question,
            "answers" => $answers,
            "comments" => $comments,
        ];

        $view->add("pages/questions/show", $data);
        //$view->add("blocks/footer", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Show the questions page filtered by tag.
     *
     * @param int   $tag The id of the tag.
     *
     * @return void
     */
    public function getQuestionsWithTag($tag)
    {
        $title      = "Questions";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get all the questions
        $questions = $this->di->get("questionModel")->getQuestionsWithTag($tag);

        // Get the tag name
        $tagName = $this->di->get("tagModel")->getTagName($tag);

        // Change the subtitle
        $subtitle   = "Here you will find all the questions tagged <span class='tag is-dark'>$tagName</span>!";

        $data = [
            "questions" => $questions,
            "subtitle" => $subtitle,
        ];

        $view->add("pages/questions", $data);
        $pageRender->renderPage(["title" => $title]);
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
