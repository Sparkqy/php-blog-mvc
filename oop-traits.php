<?php

interface ISayYourClass
{
    public function sayYourClass():string;
}

trait SayYourClassTrait
{
    public function sayYourClass():string
    {
        return self::class;
    }
}

class Box implements ISayYourClass
{
    use SayYourClassTrait;
}

class Human implements ISayYourClass
{
    use SayYourClassTrait;
}

$box = new Box();
$human = new Human();

echo $box->sayYourClass();
echo '<br>';
echo $human->sayYourClass();




