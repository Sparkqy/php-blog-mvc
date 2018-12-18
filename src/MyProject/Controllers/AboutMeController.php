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
        $title = 'Sparky-about';
        $this->view->renderHtml('headerMenu/about.php', [
            'title' => $title,
        ]);
    }
}