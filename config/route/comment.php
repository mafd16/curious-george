<?php
/**
 * Routes for the comment system
 */

/**
 * Route for comment page
 */
$app->router->add("comment", [$app->comController, "getComments"]);
//$di->get("router")->add("comment", [$di->get("comController"), "getComments"]);

/**
 * Route for add comment
 */
$app->router->post("comment/add", [$app->comController, "postComment"]);

/**
 * Route for delete comment (Processpage)
 */
$app->router->get("comment/delete", [$app->comController, "deleteComment"]);

/**
 * Route for edit comment. Where the controller gets the comment
 * and the user edit the comment.
 */
$app->router->get("comment/edit", [$app->comController, "getCommentToEdit"]);

/**
 * Route for edit2. Where the controller edit the comment and sends the user
 * back to page with comments.
 */
$app->router->post("comment/edit2", [$app->comController, "editComment"]);
