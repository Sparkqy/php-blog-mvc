<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 11:57
 */

namespace MyProject\Models\Users;

class User
{
    private $nickname;

    public function getNickname(): string
    {
        return $this->nickname;
    }
}
