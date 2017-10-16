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
     ]
 ];
