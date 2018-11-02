<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/1/2018
 * Time: 10:02 PM
 */

namespace MyProject\Services;

use MyProject\Models\Users\User;

class EmailSender
{
    public static function send(User $receiver, string $subject, string $templateName, array $templateVars = []): void
    {
        extract($templateVars);

        ob_start();
        require __DIR__ . '/../../../templates/mail/' . $templateName;
        $body = ob_get_contents();
        ob_end_clean();

        mail($receiver->getEmail(), $subject, $body, 'Content-Type: text/html; charset=UTF-8');
    }
}