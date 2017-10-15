<?php
/**
 * Routes for main pages.
 */
return [
    "routes" => [
        [
            "info" => "The start page.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["pagesController", "getIndex"],
        ],
        [
            "info" => "The questions page.",
            "requestMethod" => "get",
            "path" => "questions",
            "callable" => ["pagesController", "getQuestions"],
        ],
        [
            "info" => "The tags page.",
            "requestMethod" => "get",
            "path" => "tags",
            "callable" => ["pagesController", "getTags"],
        ],
        [
            "info" => "The users page.",
            "requestMethod" => "get",
            "path" => "users",
            "callable" => ["pagesController", "getUsers"],
        ],
    ]
];
