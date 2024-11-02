<?php

namespace Geekbrains\Application1\Domain\Models;

class Date
{
    private string $date;

    public function __construct()
    {
        $this->date = date("d-m-Y H:i");
    }

    public function getDate()
    {
        return $this->date;
    }
}
