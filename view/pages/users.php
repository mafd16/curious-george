<?php

// Variable for counting users
$userCount = 0;

?>

<section class="section">
    <div class="container">
        <h1 class="title">
            Users page
        </h1>
        <p class="subtitle">
            Here you will find the users!
        </p>
        <br>


        <?php foreach ($users as $user) : ?>
            <?php if (!$user->deleted) : ?>
            <!-- Code for the Gravatar:-->
            <?php $gravatarhash = md5(strtolower(trim($user->email))); ?>




            <?php if ($userCount == 0) : ?>
            <div class="tile is-ancestor">
                <div class="tile is-12 is-parent">
            <?php endif ?>

                    <!--<div class="tile is-3 is-child">-->
                    <article class="tile is-3 is-child media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=64" />
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <strong><a href=<?="mailto:" . $user->email?>><?= $user->acronym ?></a></strong>
                            </div>
                        </div>
                    </article>

<!--
                        <article class="tile is-3 is-child media">
                            <figure class="media-left">
                                <p class="image is-64x64">
                                    <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=64" />
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <strong><a href=<?="mailto:" . $user->email?>><?= $user->acronym ?></a></strong>
                                </div>
                            </div>
                        </article>
-->
                    <!--</div>-->

            <?php $userCount += 1; ?>

            <?php if ($userCount == 4) : ?>
                </div>
            </div>
            <?php $userCount = 0; ?>
            <?php endif ?>



            <?php endif ?>
        <?php endforeach ?>



    </div>
</section>
