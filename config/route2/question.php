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
     ]
 ];
