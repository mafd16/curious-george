<?php
/**
 * Routes for the question system
 */
 return [
     "routes" => [
         [
             "info" => "Route get for ask question page",
             "requestMethod" => "get",
             "path" => "ask",
             "callable" => ["questionController", "askQuestion"]
         ],
         [
             "info" => "Route post for handle asked question",
             "requestMethod" => "post",
             "path" => "add",
             "callable" => ["questionController", "saveQuestion"]
         ],
         [
             "info" => "Show one question",
             "requestMethod" => "get",
             "path" => "{id:digit}",
             "callable" => ["questionController", "showQuestion"]
         ],
         [
             "info" => "Route post for saving answer",
             "requestMethod" => "post",
             "path" => "answer",
             "callable" => ["answerController", "saveAnswer"]
         ],
         [
             "info" => "Route post for saving comment",
             "requestMethod" => "post",
             "path" => "comment",
             "callable" => ["comController", "saveComment"]
         ],
         [
             "info" => "The questions page with a tag filter.",
             "requestMethod" => "get",
             "path" => "tagged/{tag:digit}",
             "callable" => ["questionController", "getQuestionsWithTag"],
         ],
         [
             "info" => "Vote +1 for question.",
             "requestMethod" => "get",
             "path" => "voteup/{id:digit}",
             "callable" => ["questionController", "votePlusOne"],
         ],
         [
             "info" => "Vote -1 for question.",
             "requestMethod" => "get",
             "path" => "votedown/{id:digit}",
             "callable" => ["questionController", "voteMinusOne"],
         ],
     ]
 ];
