<?php

namespace Anax\View;

/**
 * View to update user.
 */

?><section class="section">

<div class="container">
<h1 class=title>Update profile for <?= $user->acronym ?></h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">


    <?= $message ?>


    <form action=<?= $di->get("url")->create("user/change"); ?> method="post">
        <!--<input type="hidden" name="article" value="comPage">-->
        Name: <input class="input" type="text" name="name" value="<?= $user->acronym ?>"><br>
        Password: <input class="input" type="password" name="password"><br>
        Repeate password: <input class="input" type="password" name="passwordagain"><br>
        <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
        <br>
        <input type="submit" value="Update" class="button is-primary">
    </form>


</div>
</div>

<hr>

</div>
</section>
