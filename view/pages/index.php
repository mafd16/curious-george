<?php
// Variable for counting tags
$tagCount = 0;
// Variable for counting users
$userCount = 0;
?>

<section class="section">
    <div class="container">
        <!--<h1 class="title">
            Curious George
        </h1>
        <p class="subtitle">
            Asks questions
        </p>
        <br>-->


        <div class="tile is-ancestor">

            <!-- Latest Questions -->
            <div class="tile is-4 is-parent">
                <div class="tile is-child">
                    <h1 class=subtitle>Latest questions</h1>
                    <hr>
                    <?php foreach ($questions as $question) : ?>
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
            <!-- End of Latest Questions -->

            <div class="tile is-1">
            </div>

            <div class="tile is-5 is-vertical is-parent">

                <!-- Most popular Tags -->
                <div class="tile is-12 is-child">
                    <h1 class=subtitle>Most popular tags</h1>
                    <hr>
                    <?php foreach ($tags as $tag) : ?>
                    <?php if ($tagCount == 0) : ?>
                    <div class="level is-mobile">
                        <div class="level-left">
                    <?php endif ?>

                        <a class="level-item" href="<?= $this->di->get("url")->create("questions/tagged/$tag->id") ?>">
                            <div class="tags has-addons">
                                <span class="tag is-dark">
                                    <?= $tag->tag ?>
                                </span>
                                <span class="tag is-light">
                                    <?= $tag->rank ?>
                                </span>
                            </div>
                        </a>
                    <?php $tagCount += 1; ?>

                    <?php if ($tagCount == 3) : ?>
                        </div>
                    </div>
                    <?php $tagCount = 0; ?>
                    <?php endif ?>

                    <?php endforeach ?>
                    <br>
                </div>
                <!-- End of Most popular Tags -->

                <!-- Most active Users -->
                <div class="tile is-12 is-child">
                    <h1 class=subtitle>Most active users</h1>
                    <hr>
                    <?php foreach ($users as $user) : ?>
                        <?php
                        if (isset($user->slogan)) {
                            $br = "<br>";
                        } else {
                            $br = "";
                        }
                        ?>

                        <?php if (!$user->deleted) : ?>
                        <!-- Code for the Gravatar:-->
                        <?php $gravatarhash = md5(strtolower(trim($user->email))); ?>

                        <?php if ($userCount == 0) : ?>
                        <!--<div class="tile is-ancestor">-->
                            <div class="tile is-12 is-parent">
                        <?php endif ?>

                                <div class="tile is-5 is-child">
                                    <article class="media">
                                        <figure class="media-left">
                                            <p class="image is-32x32">
                                                <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=32&d=monsterid" />
                                            </p>
                                        </figure>
                                        <div class="media-content">
                                            <div class="content">
                                                <strong><a href="<?= $this->di->get("url")->create("users/$user->id") ?>"><?= $user->acronym ?></a></strong>
                                                <p class="is-size-7"><?= $user->slogan . $br ?>Entries: <?= $user->entries ?></p>
                                            </div>
                                            <!--<div class="content">
                                                <p class="is-size-7">Member since <?= substr($user->created, 0, 10) ?></p>
                                            </div>-->
                                        </div>
                                    </article>
                                </div>
                                <div class="tile is-1 is-child">
                                </div>
                        <?php $userCount += 1; ?>

                        <?php if ($userCount == 2) : ?>
                            </div>
                        <!--</div>-->
                        <?php $userCount = 0; ?>
                        <?php endif ?>

                        <?php endif ?>
                    <?php endforeach ?>

                </div>
                <!-- End of Most active Users -->

            </div>
        </div>

    </div>
</section>
