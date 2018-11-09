<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 11/9/2018
 * Time: 7:07 PM
 */

namespace MyProject\Controllers;


class ContactsController extends AbstractController
{
    public function view()
    {
        $this->view->renderHtml('includes/headerMenu/contact.php', []);
    }
}