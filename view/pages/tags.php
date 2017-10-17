<?php

// Variable for counting tags
$tagCount = 0;

?>

<section class="section">
    <div class="container">
        <h1 class="title">
            Tags page
        </h1>
        <p class="subtitle">
            Here you will find the tags!
        </p>
        <br>




            <?php foreach ($tags as $tag) : ?>

            <?php if ($tagCount == 0) : ?>
            <div class="level is-mobile">
                <div class="level-left">
            <?php endif ?>

                <a class="level-item" href="<?= $this->di->get("url")->create("questions/tagged/$tag->id") ?>">
                    <span class="tag is-dark">
                        <?= $tag->tag ?>
                    </span>
                </a>
            <?php $tagCount += 1; ?>

            <?php if ($tagCount == 10) : ?>
                </div>
            </div>
            <?php $tagCount = 0; ?>
            <?php endif ?>

            <?php endforeach ?>

    </div>
</section>
