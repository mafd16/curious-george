<?php
/**
 * Routes for the comment system
 */
 return [
     "routes" => [
         [
             "info" => "Route for the comment page",
             "requestMethod" => "get",
             "path" => "comment",
             "callable" => ["comController", "getComments"]
         ],
         [
             "info" => "Route for add comment",
             "requestMethod" => "post",
             "path" => "comment/add",
             "callable" => ["comController", "postComment"]
         ],
         [
             "info" => "Route for delete comment",
             "requestMethod" => "get",
             "path" => "comment/delete",
             "callable" => ["comController", "deleteComment"]
         ],
         [
             "info" => "Route for editing the comment.",
             "requestMethod" => "get",
             "path" => "comment/edit",
             "callable" => ["comController", "getCommentToEdit"]
         ],
         [
             "info" => "Route for posting edited comment",
             "requestMethod" => "post",
             "path" => "comment/edit2",
             "callable" => ["comController", "editComment"]
         ],
         [
             "info" => "Route for accept answer",
             "requestMethod" => "get",
             "path" => "answer/accept/{id:digit}",
             "callable" => ["answerController", "acceptAnswer"]
         ],
         [
             "info" => "Vote +1 for answer.",
             "requestMethod" => "get",
             "path" => "answer/voteup/{id:digit}",
             "callable" => ["answerController", "votePlusOne"],
         ],
         [
             "info" => "Vote -1 for answer.",
             "requestMethod" => "get",
             "path" => "answer/votedown/{id:digit}",
             "callable" => ["answerController", "voteMinusOne"],
         ],
         [
             "info" => "Vote +1 for comment.",
             "requestMethod" => "get",
             "path" => "comment/voteup/{id:digit}",
             "callable" => ["comController", "votePlusOne"],
         ],
         [
             "info" => "Vote -1 for comment.",
             "requestMethod" => "get",
             "path" => "comment/votedown/{id:digit}",
             "callable" => ["comController", "voteMinusOne"],
         ],
     ]
 ];
