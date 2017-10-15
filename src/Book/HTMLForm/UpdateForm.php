<?php

namespace Anax\Book\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\Book\Book;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $book = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => null,//"Update details of the item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $book->id,
                ],

                "Title" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                    "value" => $book->title,
                ],

                "Author" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                    "value" => $book->author,
                ],

                "Image" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                    "value" => $book->image,
                ],

                "Link" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                    "value" => $book->link,
                ],

                "Year" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                    "value" => $book->year,
                ],

                "submit" => [
                    "type" => "submit",
                    "class" => "button is-primary",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type" => "reset",
                    "class" => "button",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return object book.
     */
    public function getItemDetails($id)
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        $book->find("id", $id);
        return $book;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        $book->find("id", $this->form->value("id"));
        //$book->column1 = $this->form->value("column1");
        //$book->column2 = $this->form->value("column2");
        $book->title = $this->form->value("Title");
        $book->author = $this->form->value("Author");
        $book->image = $this->form->value("Image");
        $book->link = $this->form->value("Link");
        $book->year = $this->form->value("Year");
        $book->save();
        //$this->di->get("response")->redirect("book/update/{$book->id}");
        $this->di->get("response")->redirect("book");
    }
}
