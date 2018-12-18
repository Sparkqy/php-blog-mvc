<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 9/21/2018
 * Time: 9:28 AM
 */

namespace MyProject\Controllers;


use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\UserActivationException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

class UsersController extends AbstractController
{
    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()], 422);
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }

    public function logout()
    {
        User::logout();
        header('Location: /');
        exit();
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()], 422);
                return;
            }
        }

        if ($user instanceof User) {
            $code = UserActivationService::createActivationCode($user);

            EmailSender::send($user, 'Activation', 'userActivation.php', [
                'userId' => $user->getId(),
                'code' => $code,
            ]);

            $this->view->renderHtml('users/signUp.php',
                ['rSuccess' => 'Registration successful, activation email was sent to your email address.']);
            return;
        }

        $this->view->renderHtml('users/signUp.php');
    }

    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);

        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

        if ($isCodeValid) {
            $user->activate();
            $this->view->renderHtml('mail/userActivationSuccessful.php', [], 302);
            UserActivationService::deleteActivationCode($userId, $activationCode);
        }
    }
}