<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "request" => [
            "shared" => true,
            "callback" => function () {
                $request = new \Anax\Request\Request();
                $request->init();
                return $request;
            }
        ],
        "response" => [
            "shared" => true,
            //"callback" => "\Anax\Response\Response",
            "callback" => function () {
                $obj = new \Anax\Response\ResponseUtility();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "url" => [
            "shared" => true,
            "callback" => function () {
                $url = new \Anax\Url\Url();
                $request = $this->get("request");
                $url->setSiteUrl($request->getSiteUrl());
                $url->setBaseUrl($request->getBaseUrl());
                $url->setStaticSiteUrl($request->getSiteUrl());
                $url->setStaticBaseUrl($request->getBaseUrl());
                $url->setScriptName($request->getScriptName());
                $url->configure("url.php");
                $url->setDefaultsFromConfiguration();
                return $url;
            }
        ],
        "router" => [
            "shared" => true,
            "callback" => function () {
                $router = new \Anax\Route\Router();
                $router->setDI($this);
                $router->configure("route2.php");
                return $router;
            }
        ],
        "view" => [
            "shared" => true,
            "callback" => function () {
                $view = new \Anax\View\ViewCollection();
                $view->setDI($this);
                $view->configure("view.php");
                return $view;
            }
        ],
        "viewRenderFile" => [
            "shared" => true,
            "callback" => function () {
                $viewRender = new \Anax\View\ViewRenderFile2();
                $viewRender->setDI($this);
                return $viewRender;
            }
        ],
        "session" => [
            "shared" => true,
            "active" => true,
            "callback" => function () {
                $session = new \Anax\Session\SessionConfigurable();
                $session->configure("session.php");
                $session->start();
                return $session;
            }
        ],
        "textfilter" => [
            "shared" => true,
            "callback" => "\Anax\TextFilter\TextFilter",
        ],
        "errorController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\ErrorController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "debugController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\DebugController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "flatFileContentController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\FlatFileContentController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "pageRender" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\PageRender();
                $obj->setDI($this);
                return $obj;
            }
        ],
        /*"rem" => [
            "shared" => true,
            "callback" => function () {
                $rem = new \Anax\RemServer\RemServer();
                $rem->injectSession($this->get("session"));
                // Load default values (and init rem server)
                $rem->configure("remserver.php");
                //$rem->init();
                return $rem;
            }
        ],*/
        /*"remController" => [
            "shared" => false,
            "callback" => function () {
                $rem = new \Anax\RemServer\RemServerController();
                $rem->setDI($this);
                return $rem;
            }
        ],*/
        "com" => [
            "shared" => true,
            "callback" => function () {
                $com = new \Mafd16\Comment\CommentModel();
                $com->setDI($this);
                return $com;
            }
        ],
        "comController" => [
            "shared" => false,
            "callback" => function () {
                $comController = new \Mafd16\Comment\CommentController();
                $comController->setDI($this);
                return $comController;
            }
        ],
        "user" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\User\UserModel();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\User\UserController();
                $obj->setDI($this);
                $obj->setUp();
                return $obj;
            }
        ],
        "db" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Database\DatabaseQueryBuilder();
                $obj->configure("database.php");
                return $obj;
            }
        ],
        /*"bookController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Book\BookController();
                $obj->setDI($this);
                return $obj;
            }
        ],*/
        "pagesController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\Pages\PagesController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "answerModel" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\Comment\AnswerModel();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "answerController" => [
            "shared" => false,
            "callback" => function () {
                $obj = new \Mafd16\Comment\AnswerController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "questionModel" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\Comment\QuestionModel();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "questionController" => [
            "shared" => false,
            "callback" => function () {
                $obj = new \Mafd16\Comment\QuestionController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "tagModel" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Mafd16\Comment\TagModel();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "tagController" => [
            "shared" => false,
            "callback" => function () {
                $obj = new \Mafd16\Comment\TagController();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
