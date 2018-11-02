<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/4/2018
 * Time: 6:47 PM
 */

namespace MyProject\Models\Buttons;


class Button
{
    public $page;
    public $text;
    public $isActive;

    public function __construct($page, $isActive = true, $text = null)
    {
        $this->page = $page;
        $this->text = is_null($text) ? $page : $text;
        $this->isActive = $isActive;
    }
}