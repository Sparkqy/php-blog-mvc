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
        if (empty($loginData['lEmail'])) {
            throw new InvalidArgumentException('Empty email field.');
        }

        if (empty($loginData['lPassword'])) {
            throw new InvalidArgumentException('Empty password field.');
        }

        $user = User::getByOneColumn('email', $loginData['lEmail']);

        if ($user === null) {
            throw new InvalidArgumentException('User does not exist.');
        }

        if (!password_verify($loginData['lPassword'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Wrong password.');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('User is not confirmed.');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    public static function logout()
    {
        setcookie('token', null, time() - 3600, '/');
    }

    public static function signUp(array $userData): User
    {
        // Nickname validate
        if (empty($userData['rNickname'])) {
            throw new InvalidArgumentException('Empty nickname field.');
        }

        if (!preg_match('/[a-zA-z0-9]+/', $userData['rNickname'])) {
            throw new InvalidArgumentException('Nickname must contain only latin symbols and numbers');
        }

        if (static::getByOneColumn('nickname', $userData['rNickname']) !== null) {
            throw new InvalidArgumentException('User with this nickname already exists.');
        }

        // Email validate
        if (empty($userData['rEmail'])) {
            throw new InvalidArgumentException('Empty email field.');
        }

        if (!filter_var($userData['rEmail'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Wrong email address.');
        }

        if (static::getByOneColumn('email', $userData['rEmail']) !== null) {
            throw new InvalidArgumentException('User with this email already exists.');
        }

        // Password validate
        if (empty($userData['rPassword'])) {
            throw new InvalidArgumentException('Empty password field.');
        }

        if (mb_strlen($userData['rPassword']) <= 8) {
            throw new InvalidArgumentException('Password must contain 8 symbols or more.');
        }

        // Create new user
        $user = new User();
        // User data
        $user->nickname = $userData['rNickname'];
        $user->email = $userData['rEmail'];
        $user->passwordHash = password_hash($userData['rPassword'], PASSWORD_DEFAULT);
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
