<?php

class Post
{
    protected $title;
    protected $text;

    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function setTitle(string $title):void
    {
        $this->title = $title;
    }

    public function setText(string $text):void
    {
        $this->text = $text;
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function getText():string
    {
        return $this->text;
    }
}

class Lesson extends Post
{
    private $homework;

    public function __construct(string $title, string $text, string $homework)
    {
        parent::__construct($title, $text);
        $this->homework = $homework;
    }

    public function setHomework(string $homework):void
    {
        $this->homework = $homework;
    }

    public function getHomework():string
    {
        return $this->homework;
    }
}

class PaidLesson extends Lesson
{
    private $price;

    public function __construct(string $title, string $text, string $homework, float $price)
    {
        parent::__construct($title, $text, $homework);
        $this->price = (float) $price;
    }

    public function setPrice(float $price):void
    {
        $this->price = (float) $price;
    }

    public function getPrice():float
    {
        return $this->price;
    }
}

$paidLesson = new PaidLesson('Paid lesson', 'Money is our everything', 'Prepare a bill', 25);


interface CalcSquare
{
    public function calcSquare():float;
}

class Circle implements CalcSquare
{
    const PI = 3.1416;
    private $r;

    public function __construct(float $radius)
    {
        $this->r = $radius;
    }

    public function setRadius(float $r):void
    {
        $this->r = (float) $r;
    }

    public function getRadius():float
    {
        return $this->r;
    }

    public function calcSquare():float
    {
        return ($this->r ** 2) * self::PI;
    }
}

class Square implements CalcSquare
{
    private $x;

    public function __construct(float $x)
    {
        $this->x = $x;
    }

    public function calcSquare():float
    {
        return $this->x ** 2;
    }
}

class Rectangle
{
    private $x;
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function calculateSquare(): float
    {
        return $this->x * $this->y;
    }
}

$objects = [
    new Square(5),
    new Square(10),
    new Circle(5),
    new Rectangle(2, 4),
];

foreach ($objects as $object)
{
    if ($object instanceof CalcSquare)
    {
        echo "Object " . get_class($object) . " implements CalcSquare interface. Square is: " . $object->calcSquare();
        echo "<br>";
        continue;
    }
    echo "Object " . get_class($object) . " does not implement interface";
}


// Static methods and properties

class User
{
    public static $count = 0;

    public function __construct()
    {
        return self::$count++;
    }

    public static function getCount()
    {
        return self::$count;
    }
}

$user1 = new User();
$user2 = new User();

echo "We are strong together. Users exists " . User::getCount();