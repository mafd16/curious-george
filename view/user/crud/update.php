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
        Name: <input class="input" type="text" name="name" value="<?= $user->acronym ?>"><br>
        Password: <input class="input" type="password" name="password"><br>
        Repeate password: <input class="input" type="password" name="passwordagain"><br>

        Slogan: <input class="input" type="text" name="slogan" value="<?= $user->slogan ?>"><br>
        Birth YYYY-MM-DD: <input class="input" type="text" name="birth" value="<?= $user->birth ?>"><br>
        City: <input class="input" type="text" name="city" value="<?= $user->city ?>"><br>
        Country: <input class="input" type="text" name="country" value="<?= $user->country ?>"><br>

        <br>
        <input type="submit" value="Update" class="button is-primary">
    </form>


</div>
</div>

<hr>

</div>
</section>
