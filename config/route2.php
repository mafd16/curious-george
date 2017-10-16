<?php
/**
 * Configuration file for routes.
 */
return [
    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // These are for internal error handling and exceptions
            "mount" => null,
            "file" => __DIR__ . "/route2/internal.php",
        ],
        [
            // For debugging and development details on Anax
            "mount" => "debug",
            "file" => __DIR__ . "/route2/debug.php",
        ],
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route2/flat-file-content.php",
        ],
        [
            // For the comment system
            "mount" => "questions",
            "file" => __DIR__ . "/route2/question.php",
        ],
        [
            // For the comment system
            "mount" => null,
            "file" => __DIR__ . "/route2/comment.php",
        ],
        [
            // Add routes from userController and mount on user/
            "mount" => "user",
            "file" => __DIR__ . "/route2/userController.php",
        ],
        [
            // Add routes from pagesController
            "mount" => null,
            "file" => __DIR__ . "/route2/pages.php",
        ],
        [
            // Keep this last since its a catch all
            "mount" => null,
            "file" => __DIR__ . "/route2/404.php",
        ],
    ],
];
