<?php

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;

?>

<section class="section">
    <div class="container">
        <h1 class="title">
            Questions page
        </h1>
        <p class="subtitle">
            <?= $subtitle ?>
            <!--Here you will find the questions!-->
        </p>

        <div class="container">
            <a class="button is-primary" href="<?= $di->url->create("questions/ask") ?>">
                Ask a question
            </a>

            <br>
            <hr>
            <br>

            <?php foreach (array_reverse($questions) as $question) : ?>
            <article class="media">
                <!--<figure class="media-left">
                    <p class="image is-64x64">-->
            <!--<img src="http://bulma.io/images/placeholders/128x128.png">-->
                        <!--<img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=64" />
                    </p>
                </figure>-->
                <div class="media-content">
                    <div class="content">
                        <strong>
                            <a href="<?= $this->di->get("url")->create("questions/$question->id") ?>">
                                <?= $question->title ?>
                            </a>
                        </strong>

                        <div class="field is-grouped is-grouped-multiline">
                            <div class="control">
                                <div class="tags has-addons">
                                    <span class="tag is-light">Answers</span>
                                    <span class="tag is-white"><?= $noOfAnswers[$question->id] ?></span>
                                </div>
                            </div>

                            <div class="control">
                                <div class="tags has-addons">
                                    <span class="tag is-light">Rank</span>
                                    <span class="tag is-white"><?= $question->rank ?></span>
                                </div>
                            </div>
                        </div>

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
</section>
