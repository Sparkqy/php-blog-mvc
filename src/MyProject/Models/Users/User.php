<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 11:57
 */

namespace MyProject\Models\Users;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\Db;
use MyProject\Services\UsersAuthService;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $passwordHash;
    protected $isConfirmed;
    protected $role;
    protected $authToken;

    protected static function getTableName(): string
    {
        return 'users';
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function getNickname(): string
    {
        return ucfirst($this->nickname);
    }
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    public function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    public static function login(array $loginData): User
    {
        if (empty($loginData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        $user = User::getByOneColumn('email', $loginData['email']);
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким email');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('Пользователь не подтверждён');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    public static function logout()
    {
        setcookie('token', null, time()-3600, '/');
    }

    public static function signUp(array $userData): User
    {
        // nickname validate
        if (empty($userData['nickname']))
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Не передан никнейм');
        }
        if (!preg_match('/[a-zA-z0-9]+/', $userData['nickname']))
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Никнейм может состоять
            из латинских букв и цифр');
        }
        if (static::getByOneColumn('nickname', $userData['nickname']) !== null)
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Пользователь с таким никнеймом
            уже существует');
        }
        // email validate
        if (empty($userData['email']))
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Не передан адрес эл. почты');
        }
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL))
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Введен некорректный эл. адрес');
        }
        if (static::getByOneColumn('email', $userData['email']) !== null)
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Данный эл. адрес уже используется');
        }
        // password validate
        if (empty($userData['password']))
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Не передан пароль');
        }
        if (mb_strlen($userData['password']) <= 8)
        {
            throw new \MyProject\Exceptions\InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }

        // create new user
        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;
    }

    public function activate(): void
    {
        $this->isConfirmed = true;
        $this->save();
    }
}
