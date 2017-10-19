<?php

namespace Anax\View;

/**
 * View to display user profile.
 */

// If not logged in, redirect!
if (!$di->get("session")->has("my_user_id")) {
    $di->get("response")->redirect("user/login");
}

// Create gravatar for user!
$gravatarhash = md5(strtolower(trim($user->email)));

?><section class="section">

<div class="container">

<h1 class=title>Profile page</h1>
<hr>
<!--<p>
    <a href="<?= $urlToCreate ?>">Create</a> |
    <a href="<?= $urlToDelete ?>">Delete</a>
</p>-->
<br>

<article class="media">
    <figure class="media-left">
        <p class="image is-64x64">
            <!--<img src="http://bulma.io/images/placeholders/128x128.png">-->
            <img src="https://www.gravatar.com/avatar/<?= $gravatarhash ?>?s=64&d=monsterid" />
        </p>
    </figure>
</article>

<br>

<p>Name: <?= $user->acronym; ?> </p>
<p>Slogan: <?= $user->slogan; ?> </p>
<p>Birth: <?= $user->birth; ?> </p>
<p>City: <?= $user->city; ?> </p>
<p>Country: <?= $user->country; ?> </p>
<p>Email: <?= $user->email; ?> </p>
<p>Created: <?= $user->created; ?> </p>
<p>Updated: <?= $user->updated; ?> </p>
<p>Admin: <?= $user->admin ? "Yes" : "No"; ?> </p>

<hr>

<a href="<?= $di->get("url")->create("user/update") ?>">Update profile</a>

<?php if ($user->admin) : ?>
    | <a href="<?= $di->get("url")->create("user/admin") ?>">Handle users</a>
<?php endif ?>

<br>
<br>


</div>
</section>
