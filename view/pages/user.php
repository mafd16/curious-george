<?php

//namespace Anax\View;

/**
 * View to display user profile.
 */

// Create gravatar for user!
$gravatarhash = md5(strtolower(trim($user->email)));


?>

<section class="section">
    <div class="container">

        <!--<h1 class=title>Profile page</h1>
        <hr>-->

        <br>

        <div class="tile is-ancestor">
            <div class="tile is-12 is-parent">
                <div class="tile is-4 is-child">

                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-128x128">
                                <!--<img src="http://bulma.io/images/placeholders/128x128.png">-->
                                <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=128" />
                            </p>
                        </figure>
                        <div class="media-content">
                            <!--<div class="content">-->
                                <strong><?= $user->acronym ?></strong>
                            <!--</div>-->
                            <!--<div class="content">-->
                                <p class="is-size-7">Location: <?= $user->city ?>, <?= $user->country ?></p>
                                <p class="is-size-7">Age: <?= $age ?></p>
                                <!--<p class="is-size-7">Email: <?= $user->email ?></p>-->
                            <!--</div>-->
                        </div>
                    </article>
                </div>
                <div class="tile is-4 is-child">
                    <article class="media">
                        <figure class="media-right">
                            <p class="is-size-7">Member since <?= substr($user->created, 0, 10) ?></p>
                            <p class="is-size-7">Questions: <?= $stats->questions ?></p>
                            <p class="is-size-7">Answers: <?= $stats->answers ?></p>
                            <p class="is-size-7">Comments: <?= $stats->comments ?></p>
                        </figure>
                    </article>
                </div>
            </div>
        </div>

        <br>
        <!--<hr>-->

        <div class="tile is-ancestor">
            <div class="tile is-12 is-parent">
                <div class="tile is-4 is-child">
                    <h1 class=subtitle>Questions asked by <?= $user->acronym ?></h1>
                    <hr>

                    <?php foreach (array_reverse($askedQuestions) as $question) : ?>

                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <strong>
                                        <a href="<?= $this->di->get("url")->create("questions/$question->id") ?>">
                                            <?= $question->title ?>
                                        </a>
                                    </strong>

                                    <?php
                                    if (substr($question->question, 0, 30) == $question->question) {
                                        $dots = null;
                                    } else {
                                        $dots = " ...";
                                    }
                                    ?>

                                    <p><?= substr($question->question, 0, 30) . $dots ?></p>


                                </div>
                                <nav class="level is-mobile">
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
                                </nav>
                            </div>
                        </article>

                    <?php endforeach ?>
                </div>
                <div class="tile is-1 is-child">
                </div>

                <div class="tile is-4 is-child">
                    <h1 class=subtitle>Questions answered by <?= $user->acronym ?></h1>
                    <hr>

                    <?php foreach (array_reverse($answeredQuestions) as $question) : ?>

                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <strong>
                                        <a href="<?= $this->di->get("url")->create("questions/$question->id") ?>">
                                            <?= $question->title ?>
                                        </a>
                                    </strong>

                                    <?php
                                    if (substr($question->question, 0, 30) == $question->question) {
                                        $dots = null;
                                    } else {
                                        $dots = " ...";
                                    }
                                    ?>

                                    <p><?= substr($question->question, 0, 30) . $dots ?></p>


                                </div>
                                <nav class="level is-mobile">
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
                                </nav>
                            </div>
                        </article>

                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <br>
        <br>


    </div>
</section>
