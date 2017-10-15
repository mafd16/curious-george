<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");



?><section class="section">

<div class="container">

<h1 class=title>List of all books</h1>
<hr>
<p>
    <a href="<?= $urlToCreate ?>">Create</a> |
    <a href="<?= $urlToDelete ?>">Delete</a>
</p>
<br>

<?php if (!$items) : ?>
    <p>There are no books to show.</p>
<?php
    return;
endif;
?>

<table class="table">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Image</th>
        <th>Link</th>
        <th>Year</th>
    </tr>
    <?php foreach ($items as $item) : ?>
    <tr>
        <td>
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $item->title ?></td>
        <td><?= $item->author ?></td>
        <td><?= $item->image ?></td>
        <td><?= $item->link ?></td>
        <td><?= $item->year ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<hr>
<br>
