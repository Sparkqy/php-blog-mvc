<?php

abstract class AbstractClass
{
    abstract public function getVal();

    public function printVal()
    {
        echo 'This is "real" method inside abstract class' . '<br>';
        echo $this->getVal();
    }
}

class AbstractChild extends AbstractClass
{
    private $val;

    public function __construct(string $val)
    {
        $this->val = $val;
    }

    public function getVal()
    {
        return $this->val;
    }
}

$obj = new AbstractChild('This will print value of abstract method of abstract class extended');
$obj->printVal();

echo '<br><br> Task <br>';


// task
abstract class HumanAbstract
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function getGreetings(): string;
    abstract public function getMyNameIs(): string;

    public function introduceYourself(): string
    {
        return $this->getGreetings() . '! ' . $this->getMyNameIs() . ' ' . $this->getName();
    }
}

class RussianHuman extends HumanAbstract
{

    public function getGreetings(): string
    {
        return 'Привет, человек';
    }

    public function getMyNameIs(): string
    {
        return 'Меня зовут ';
    }
}

class EnglishHuman extends HumanAbstract
{

    public function getGreetings(): string
    {
        return 'Hi human ';
    }

    public function getMyNameIs(): string
    {
        return 'My name is ';
    }
}

$russianHuman = new RussianHuman('Илья');
$englishHuman = new EnglishHuman('Ilya');

echo $russianHuman->introduceYourself() . '<br>';
echo $englishHuman->introduceYourself();