<?php

namespace Mafd16\Pages;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use DateTime;

/**
 * A controller class for the main pages.
 */
class PagesController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Show the index page.
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Curious George";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        //$book = new Book();
        //$book->setDb($this->di->get("db"));

        $data = [
            //"items" => $book->findAll(),
            "items" => "an item",
        ];

        $view->add("pages/index", $data);
        //$view->add("blocks/footer", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Show the questions page.
     *
     * @return void
     */
    public function getQuestions()
    {
        $title      = "Questions";
        $subtitle   = "Here you will find all the questions!";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get all the questions
        $questions = $this->di->get("questionModel")->getQuestions();

        $data = [
            "questions" => $questions,
            "subtitle" => $subtitle,
        ];

        $view->add("pages/questions", $data);
        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Show the tags page.
     *
     * @return void
     */
    public function getTags()
    {
        $title      = "Tags";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        // Get all the tags from db
        $tags = $this->di->get("tagModel")->getAllTags();

        $data = [
            //"items" => $book->findAll(),
            "tags" => $tags,
        ];

        $view->add("pages/tags", $data);
        //$view->add("blocks/footer", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Show the users page.
     *
     * @return void
     */
    public function getUsers()
    {
        $title      = "Users";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        // Get all the users from db
        $users = $this->di->get("user")->getAllUsers();

        $data = [
            //"items" => $book->findAll(),
            "users" => $users,
        ];

        $view->add("pages/users", $data);
        //$view->add("blocks/footer", $data);

        $pageRender->renderPage(["title" => $title]);
    }


    /**
     * Show a users public page.
     *
     * @param int   $id The users id
     *
     * @return void
     */
    public function getUserPublic($id)
    {
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        // Get the user from db
        $user = $this->di->get("user")->getUserFromDatabase("id", $id);
        // Get the users questions
        $askedQuestions = $this->di->get("questionModel")->getQuestionsWhere("userId", $user->id);
        // Get the users answers
        $answers = $this->di->get("answerModel")->getAnswersWhere("userId", $user->id);
        // Get questions answered by user
        $answeredQuestions = $this->di->get("questionModel")->getQuestionsAnsweredByUser($answers);

        // Get the users comments
        $comments = $this->di->get("com")->getCommentsWhere("userId", $user->id);
        // Construct the title
        $title = "User $user->acronym";
        // Calculate age for user
        $from = new DateTime($user->birth);
        $to   = new DateTime('today');
        $age = $from->diff($to)->y;
        // Collect the user statistics
        $stats = (object) [
            "questions" => count($askedQuestions),
            "answers" => count($answers),
            "comments" => count($comments),
        ];

        $data = [
            "user" => $user,
            "askedQuestions" => $askedQuestions,
            "answeredQuestions" => $answeredQuestions,
            "stats" => $stats,
            "answers" => $answers,
            "age" => $age,
        ];

        $view->add("pages/user", $data);
        $pageRender->renderPage(["title" => $title]);
    }
}
