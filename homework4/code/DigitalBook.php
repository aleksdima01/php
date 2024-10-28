<?php

require_once "Book.php";

class DigitalBook extends Book
{
    public string $url;

    public function __construct(string $name, array $authors, int $countOfReads, string $url)
    {
        parent::__construct($name, $authors, $countOfReads);
        $this->url = $url;
    }
    public function getBook(): string
    {
        return $this->url;
    }
}
