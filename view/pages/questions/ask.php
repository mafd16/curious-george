<?php

// Gather incoming variables and use default values if not set
//$comments = isset($comments) ? $comments : null;
//$tags = isset($tags) ? $tags : null;
$tags = isset($tags) ? $tags : ["php", "javascript", "html", "css"];

?>

<section class="section">
    <div class="container">
        <h1 class="title">
            Ask a question
        </h1>


        <hr>


        <?php if ($di->get("session")->has("my_user_id")) : ?>

            <div class="columns is-mobile">
                <div class="column is-two-third-tablet is-half-desktop">
                    <form action=<?= $di->get("url")->create("questions/add"); ?> method="post">
                        <input class="input" type="hidden" name="userId" value=<?= $di->get("session")->get("my_user_id") ?>>
                        Title: <input class="input" type="text" name="title" autofocus required><br>
                        Description: <textarea class="textarea" name="question" required></textarea><br>
                        Tags (max 3 tags):
                        <input list="tags" class="input" name="tag1"><br><br>
                        <input list="tags" class="input" name="tag2"><br><br>
                        <input list="tags" class="input" name="tag3"><br><br>

                        <datalist id="tags">
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?= $tag ?>">
                        <?php endforeach ?>

                        </datalist>

                        <input type="submit" value="Post question" class="button is-primary">
                    </form>
                </div>
            </div>
        <?php else : ?>
            <p>You need to be logged in to ask questions!</p>
        <?php endif ?>

    </div>
</section>
