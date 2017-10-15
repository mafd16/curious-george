<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToViewItems = url("book");



?><section class="section">

<div class="container">

<h1 class=title>Add a book!</h1>
<hr>
<div class="columns is-mobile">
<div class="column is-two-third-tablet is-half-desktop">

<?= $form ?>

</div>
</div>
<hr>
<p>
    <a href="<?= $urlToViewItems ?>">View all books!</a>
</p>
</div>

</section>
