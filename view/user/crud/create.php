<?php

namespace Anax\View;

/**
 * View to create user.
 */

?><section class="section">

<div class="container">
<h1 class=title>Sign up</h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">


    <?= $message ?>


    <form action=<?= $di->get("url")->create("user/creating"); ?> method="post">
        <!--<input type="hidden" name="article" value="comPage">-->
        Name: <input class="input" type="text" name="name" autofocus required><br>
        Email: <input class="input" type="text" name="email" required><br>
        Password: <input class="input" type="password" name="password" required><br>
        Repeat password: <input class="input" type="password" name="passwordagain" required><br>
        <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
        <br>
        <input type="submit" value="Sign up" class="button is-primary">
    </form>


</div>
</div>

<hr>

</div>
</section>
