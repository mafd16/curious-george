<?php

// Gather incoming variables and use default values if not set
$question = isset($question) ? $question : null;
$answers = isset($answers) ? $answers : null;
$comments = isset($comments) ? $comments : null;


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
            <?= $question->question ?>

            <p class="is-size-7">Asked by
            <?php
            $user = $this->di->get("user")->getUserFromDatabase("id", $question->userId);
            ?>
            <a href="<?= $this->di->get("url")->create("users/$user->id") ?>"><?= $user->acronym ?></a>
            <?= $question->created ?></p>

            <!-- Vote question -->
            <a title="Vote +1" class="is-pulled-left" href="<?= $this->di->get("url")->create("questions/voteup/$question->id") ?>">
                <i class="fa fa-chevron-up" aria-hidden="true"></i>
            </a>
            <div class="is-pulled-left">
                <span class="tag is-white"><?= isset($question->rank) ? $question->rank : "0" ?></span>
            </div>
            <a title="Vote -1" class="is-pulled-left" href="<?= $this->di->get("url")->create("questions/votedown/$question->id") ?>">
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>
            <!-- End of Vote question -->
            <br>
            <br>
            <!-- Question tags -->
            <div class="level is-mobile">
                <div class="level-left">
                <?php if ($question->tag1Id) : ?>
                    <a class="level-item" href="<?= $this->di->get("url")->create("questions/tagged/$question->tag1Id") ?>">
                        <span class="tag is-dark">
                            <?= $this->di->get("tagModel")->getTagName($question->tag1Id) ?>
                        </span>
                    </a>
                <?php endif ?>
                <?php if ($question->tag2Id) : ?>
                    <a class="level-item" href="<?= $this->di->get("url")->create("questions/tagged/$question->tag2Id") ?>">
                        <span class="tag is-dark">
                            <?= $this->di->get("tagModel")->getTagName($question->tag2Id) ?>
                        </span>
                    </a>
                <?php endif ?>
                <?php if ($question->tag3Id) : ?>
                    <a class="level-item" href="<?= $this->di->get("url")->create("questions/tagged/$question->tag3Id") ?>">
                        <span class="tag is-dark">
                            <?= $this->di->get("tagModel")->getTagName($question->tag3Id) ?>
                        </span>
                    </a>
                <?php endif ?>
                </div>
            </div>
            <!-- End of question -->

            <!-- Comments to the question -->
            <?php foreach ($comments as $comment) : ?>
            <?php if (!$comment->answerId) : ?>
            <div class="is-size-7 is-pulled-left">
            <?= $comment->comment ?>
            </div>

            <?php
            $user = $this->di->get("user")->getUserFromDatabase("id", $comment->userId);
            ?>
            <div class="is-size-7 is-pulled-left"> &rarr; <a href="<?= $this->di->get("url")->create("users/$user->id") ?>"><?= $user->acronym ?></a>
            <?= $comment->created ?>
            </div>


            <!-- Vote comment -->
            <div class="is-size-7">
                <a title="Vote +1" class="is-pulled-left" href="<?= $this->di->get("url")->create("comment/voteup/$comment->id") ?>">
                    <!--<i class="fa fa-angle-up" aria-hidden="true"></i>-->
                    <span class="tag is-white">+1</span>
                </a>
                <div class="is-pulled-left">
                    <span class="tag is-light"><?= isset($comment->rank) ? $comment->rank : "0" ?></span>
                </div>
                <a title="Vote -1" href="<?= $this->di->get("url")->create("comment/votedown/$comment->id") ?>">
                    <!--<i class="fa fa-angle-down" aria-hidden="true"></i>-->
                    <span class="tag is-white">-1</span>
                </a>
            </div>
            <!-- End of Vote comment -->



            <?php endif ?>
            <?php endforeach ?>
            <!-- End of comments to the question -->


            <br>


            <!-- Post a new comment to the question -->
            <!--<a class="is-size-7" onclick="togglePostComment()">-->
            <a class="is-size-7 comment-question">
                Comment the question
            </a>
            <br>
            <br>
            <div id="commentquestionform" style="display:none;">
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
            <a href="<?= $this->di->get("url")->create("questions/$question->id?sort=date") ?>">By date</a> | <a href="<?= $this->di->get("url")->create("questions/$question->id?sort=rank") ?>">By rank</a>
            <hr>
            <?php foreach ($answers as $answer) : ?>
            <p>
                <?php if ($question->userId == $this->di->get("session")->get("my_user_id") && !$answer->accepted) : ?>
                <a class="is-pulled-left" href="<?= $this->di->get("url")->create("answer/accept/$answer->id") ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                <?php endif ?>

                <?php if ($answer->accepted) : ?>
                <div class="is-pulled-left" title="Accepted at <?= $answer->accepted ?>">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <?php endif ?>
                <?= $answer->answer ?>
            </p>

            <p class="is-size-7">Answered by
            <?php
            $user = $this->di->get("user")->getUserFromDatabase("id", $answer->userId);
            ?>
            <a href="<?= $this->di->get("url")->create("users/$user->id") ?>"><?= $user->acronym ?></a>
            <?= $answer->created ?></p>


            <!-- Vote answer -->
            <a title="Vote +1" class="is-pulled-left" href="<?= $this->di->get("url")->create("answer/voteup/$answer->id") ?>">
                <i class="fa fa-chevron-up" aria-hidden="true"></i>
            </a>
            <div class="is-pulled-left">
                <span class="tag is-white"><?= isset($answer->rank) ? $answer->rank : "0" ?></span>
            </div>
            <a title="Vote -1" class="is-pulled-left" href="<?= $this->di->get("url")->create("answer/votedown/$answer->id") ?>">
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>
            <!-- End of Vote answer -->

            <br>
            <br>


            <!-- Comments to the answer -->
            <?php foreach ($comments as $comment) : ?>
            <p>
            <?php if ($comment->answerId == $answer->id) : ?>
                <div class="is-size-7 is-pulled-left">
                <?= $comment->comment ?>
                </div>

                <?php
                $user = $this->di->get("user")->getUserFromDatabase("id", $comment->userId);
                ?>
                <div class="is-size-7 is-pulled-left"> &rarr; <a href="<?= $this->di->get("url")->create("users/$user->id") ?>"><?= $user->acronym ?></a>
                <?= $comment->created ?>
                </div>

                <!-- Vote comment -->
                <div class="is-size-7">
                    <a title="Vote +1" class="is-pulled-left" href="<?= $this->di->get("url")->create("comment/voteup/$comment->id") ?>">
                        <!--<i class="fa fa-angle-up" aria-hidden="true"></i>-->
                        <span class="tag is-white">+1</span>
                    </a>
                    <div class="is-pulled-left">
                        <span class="tag is-light"><?= isset($comment->rank) ? $comment->rank : "0" ?></span>
                    </div>
                    <a title="Vote -1" href="<?= $this->di->get("url")->create("comment/votedown/$comment->id") ?>">
                        <!--<i class="fa fa-angle-down" aria-hidden="true"></i>-->
                        <span class="tag is-white">-1</span>
                    </a>
                </div>
                <!-- End of Vote comment -->



            <?php endif ?>
            </p>
            <?php endforeach ?>
            <!-- End of comments to the answer -->

            <!-- Post a new comment to the answer -->
            <a class="is-size-7 comment-answer">
                Comment this answer
            </a>

            <div style="display:none;">
                <br>
            <?php if ($di->get("session")->has("my_user_id")) : ?>
                <div class="columns is-mobile">
                    <div class="column is-two-third-tablet is-half-desktop">
                        <form action=<?= $di->get("url")->create("questions/comment"); ?> method="post">
                            <input class="input" type="hidden" name="questionId" value=<?= $question->id ?>>
                            <input class="input" type="hidden" name="answerId" value=<?= $answer->id ?>>
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
            <!-- End of Post a new comment to the answer -->

            <hr>
            <?php endforeach ?>
            <!-- End of Answers to the question -->



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
