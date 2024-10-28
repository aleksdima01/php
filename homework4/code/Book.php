<?php


abstract class Book
{
    private string $name;
    private array $authors;
    private string $isbn;
    private int $countOfReads;
    private int $countOfPages;
    private int $shelfId;

    public function __construct(string $name, array $authors,  int $countOfReads)
    {
        $this->name = $name;
        $this->authors = $authors;
        $this->countOfReads = $countOfReads;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getAuthor(): array
    {
        return $this->authors;
    }
    public function getCountOfPages(): int
    {
        return $this->countOfPages;
    }
    public function getCountOfReads(): int
    {
        return $this->countOfReads;
    }
    public function getIsbn(): string
    {
        return $this->isbn;
    }
    public function getShelfId(): int
    {
        return $this->shelfId;
    }
    public function setCountOfPages(int $count): void
    {
        $this->countOfPages = $count;
    }

    public abstract function getBook();
}
