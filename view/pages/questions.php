<?php

?>

<section class="section">
    <div class="container">
        <h1 class="title">
            Questions page
        </h1>
        <p class="subtitle">
            Here you will find the questions!
        </p>

        <div class="container">
            <a class="button is-primary" href="<?= $di->url->create("questions/ask") ?>">
                Ask a question
            </a>

            <br>
            <br>
            
            <p>Questions</p>
            <p>This is <?= $q1 ?>.</p>
            <p>This is <?= $q2 ?>.</p>
        </div>

    </div>
</section>
