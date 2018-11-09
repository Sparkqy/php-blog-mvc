<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 11/8/2018
 * Time: 9:17 AM
 */

namespace MyProject\Controllers;


class AboutMeController extends AbstractController
{
    public function view()
    {
        $this->view->renderHtml('includes/headerMenu/about.php', []);
    }
}