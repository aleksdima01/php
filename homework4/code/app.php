<?php
require_once "Room.php";
require_once "Shelf.php";
require_once "DigitalBook.php";
require_once "PaperBook.php";
$digbook = new DigitalBook("Преступление и наказание", ["Фёдор Михайлович Достоевский"], 0, "http://asasd.sa");
$room = new Room(1, "Ул. Маяковского, дом 14");
$shelf = new Shelf(1, $room, 25);
$paperBook = new PaperBook("Преступление и наказание", ["Фёдор Михайлович Достоевский"], 0, $shelf);
echo $digbook->getBook() . PHP_EOL;
echo $paperBook->getBook() . PHP_EOL;

class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

// class A
// {
//     public function foo()
//     {
//         static $x = 0;
//         echo ++$x;
//     }
// }
// class B extends A {}
// $a1 = new A();
// $b1 = new B();
// $a1->foo();
// $b1->foo();
// $a1->foo();
// $b1->foo();

//Выводы одинаковые в первом и втором случае