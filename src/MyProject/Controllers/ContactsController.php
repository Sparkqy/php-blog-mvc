<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 11/9/2018
 * Time: 7:07 PM
 */

namespace MyProject\Controllers;


use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ContactMessages\ContactMessage;

class ContactsController extends AbstractController
{
    public function view()
    {
        $this->view->renderHtml('headerMenu/contact.php', []);
    }

    public function sendMessage()
    {
        if (!empty($_POST)) {
            try {
                ContactMessage::sendMessage($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('headerMenu/contact.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /contact', true, 302);
            exit();
        }

        $this->view->renderHtml('headerMenu/contact.php', []);
    }
}