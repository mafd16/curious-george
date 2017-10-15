<?php

namespace Anax\View;

/**
 * View to display user login.
 */

?>
<section class="section">
  <div class="container">
    <h1 class="title">
      Log in
    </h1>
    <p class="subtitle">
        using email and password
    </p>

<hr>



<div class="columns is-mobile">
  <div class="column is-two-third-tablet is-half-desktop">
      <form action=<?= $di->get("url")->create("user/validate"); ?> method="post">
          <!--<input type="hidden" name="article" value="comPage">-->
          Email: <input class="input" type="text" name="email" autofocus required><br>
          Password: <input class="input" type="password" name="password" required><br>
          <!--Kommentar: <input class="textarea" type="text" name="comment"><br>-->
          <br>
          <input type="submit" value="Log in" class="button is-primary">
      </form>
  </div>
</div>

<?= $message ?>

<hr>

<a href="<?= $di->get("url")->create("user/create") ?>">Sign up</a>

<!--Glömt lösenordet?-->


</div>
</section>
