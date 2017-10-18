<?php

namespace Anax\View;

/**
 * View to update user.
 */

// If not admin, redirect!
if (!$di->get("session")->get("my_user_admin")) {
    $di->get("response")->redirect("user/profile");
}

?><section class="section">

<div class="container">
<h1 class=title>Uppdatera konto <?= $user->email ?></h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">

    <?= $message ?>

    <form action=<?= $di->get("url")->create("user/admin/updating"); ?> method="post">
        <input type="hidden" name="user_id" value=<?= $user->id ?>>
        Name: <input class="input" type="text" name="name" value="<?= $user->acronym ?>"><br>

        <!--Epost: <input class="input" type="text" name="email" value="<?= $user->email ?>"><br>-->
        Admin: <input class="input" type="text" name="admin" value="<?= $user->admin ?>"><br>
        Lösenord: <input class="input" type="password" name="password"><br>
        Repetera lösenord: <input class="input" type="password" name="passwordagain"><br>
        Slogan: <input class="input" type="text" name="slogan" value="<?= $user->slogan ?>"><br>
        Birth: <input class="input" type="text" name="birth" value="<?= $user->birth ?>"><br>
        City: <input class="input" type="text" name="city" value="<?= $user->city ?>"><br>
        Country: <input class="input" type="text" name="country" value="<?= $user->country ?>"><br>
        <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
        <br>
        <input type="submit" value="Uppdatera" class="button is-primary">
    </form>


</div>
</div>

<hr>

</div>
</section>
