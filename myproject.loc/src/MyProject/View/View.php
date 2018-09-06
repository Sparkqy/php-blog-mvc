<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 05.09.2018
 * Time: 11:48
 */

namespace MyProject\View;

class View
{
    private $templatePath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function renderHtml(string $templateName, array $vars = [])
    {
        extract($vars);
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}