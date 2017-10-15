<?php

namespace Anax\Book\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\Book\Book;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => null,//"Details of the book",
            ],
            [
                "Title" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                ],

                "Author" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                ],

                "Image" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                ],

                "Link" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                ],

                "Year" => [
                    "type" => "text",
                    "class" => "input",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "class" => "button is-primary",
                    "value" => "Add book",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
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
        //$book->column1  = $this->form->value("column1");
        //$book->column2 = $this->form->value("column2");
        $book->title  = $this->form->value("Title");
        $book->author = $this->form->value("Author");
        $book->image = $this->form->value("Image");
        $book->link = $this->form->value("Link");
        $book->year = $this->form->value("Year");
        $book->save();
        $this->di->get("response")->redirect("book");
    }
}
