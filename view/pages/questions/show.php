<?php

// Gather incoming variables and use default values if not set
$question = isset($question) ? $question : null;
$answers = isset($answers) ? $answers : null;

$comments = [
    (object) [
        "questionId" => 3,
        "answerId" => null,
        "userId" => 1,
        "comment" => "comment one mocked",
    ],
    (object) [
        "questionId" => 3,
        "answerId" => 1,
        "userId" => 1,
        "comment" => "comment two mocked",
    ],
    (object) [
        "questionId" => 3,
        "answerId" => 2,
        "userId" => 1,
        "comment" => "comment three mocked",
    ],
    (object) [
        "questionId" => 3,
        "answerId" => 1,
        "userId" => 1,
        "comment" => "comment four mocked",
    ],
];

// Count the number of answers to a question
$noOfAnswers = count($answers);
if ($noOfAnswers == 1) {
    $number = $noOfAnswers . " answer";
} else {
    $number = $noOfAnswers . " answers";
}

?>

<section class="section">
    <div class="container">
        <!-- The title of the question -->
        <h1 class="title">
            <?= $question->title ?>
        </h1>
        <!--<p class="subtitle">
            Here you will find the questions!
        </p>-->

        <div class="container">
            <hr>
            <!-- The question itself -->
            <p>
                <?= $question->question ?>
            </p>
            <br>
            <!-- End of question -->

            <!-- Comments to the question -->
            <?php foreach ($comments as $comment) : ?>
            <p>
            <?php if (!$comment->answerId) : ?>
                <?= $comment->comment ?>
                <br>
                <br>
            <?php endif ?>
            </p>
            <?php endforeach ?>
            <!-- End of comments to the question -->

            <!-- Post a new comment to the question -->
            <a id="commentquestion" class="is-size-7">
                Comment the question
            </a>
            <br>
            <br>
            <div id="commentquestionform" class="hidden">
            <?php if ($di->get("session")->has("my_user_id")) : ?>
                <div class="columns is-mobile">
                    <div class="column is-two-third-tablet is-half-desktop">
                        <form action=<?= $di->get("url")->create("questions/comment"); ?> method="post">
                            <input class="input" type="hidden" name="questionId" value=<?= $question->id ?>>
                            <input class="input" type="hidden" name="userId" value=<?= $di->get("session")->get("my_user_id") ?>>
                            Comment: <textarea class="textarea" name="comment" required></textarea><br>
                            <input type="submit" value="Post comment" class="button is-primary">
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <p>You need to be logged in to comment!</p>
            <?php endif ?>
            </div>
            <!-- End of Post a new comment to the question -->


            <br>
            <!-- Answers to the question -->
            <p class="is-size-4"><?= $number ?></p>
            <hr>
            <?php foreach ($answers as $answer) : ?>
            <p>
                <?= $answer->answer ?>
            </p>
            <br>
            <!-- Comments to the answer -->
            <?php foreach ($comments as $comment) : ?>
            <p>
            <?php if ($comment->answerId == $answer->id) : ?>
                <?= $comment->comment ?>
            <?php endif ?>
            </p>
            <?php endforeach ?>
            <!-- End of comments to the answer -->

            <!-- Post a new comment to the answer -->
            <!-- End of Post a new comment to the answer -->

            <hr>
            <?php endforeach ?>

            <!-- Post a new answer -->
            <p class="is-size-4">
                Your answer
            </p>

            <?php if ($di->get("session")->has("my_user_id")) : ?>

            <div class="columns is-mobile">
                <div class="column is-two-third-tablet is-half-desktop">
                    <form action=<?= $di->get("url")->create("questions/answer"); ?> method="post">
                        <input class="input" type="hidden" name="questionId" value=<?= $question->id ?>>
                        <input class="input" type="hidden" name="userId" value=<?= $di->get("session")->get("my_user_id") ?>>
                        Answer: <textarea class="textarea" name="answer" required></textarea><br>
                        <input type="submit" value="Post answer" class="button is-primary">
                    </form>
                </div>
            </div>
            <?php else : ?>
            <p>You need to be logged in to post answers!</p>
            <?php endif ?>

            <!-- End of Post a new answer -->



        </div>
    </div>
</section>

<!-- -->
