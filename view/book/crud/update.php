<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$item = isset($item) ? $item : null;

// Create urls for navigation
$urlToView = url("book");



?><section class="section">

<div class="container">
<h1 class=title>Update book</h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">

<?= $form ?>

</div>
</div>

<hr>

<p>
    <a href="<?= $urlToView ?>">View all books!</a>
</p>
</div>

</section>
