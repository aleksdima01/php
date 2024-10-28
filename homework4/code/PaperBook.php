<?php
require_once "Book.php";

class PaperBook extends Book
{
    public Shelf $shelf;

    public function __construct(string $name, array $authors, int $countOfReads, Shelf $shelf)
    {
        parent::__construct($name, $authors, $countOfReads);
        $this->shelf = $shelf;
    }
    public function getBook(): Shelf
    {
        return $this->shelf;
    }
}
