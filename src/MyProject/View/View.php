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
    private $extraVars = [];

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function setExtraVars(string $varName, $varValue): void
    {
        $this->extraVars[$varName] = $varValue;
    }

    public function renderHtml(string $templateName, array $vars = [], int $code = 200)
    {
        http_response_code($code);

        extract($this->extraVars);
        extract($vars);

        ob_start();
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }

    public function displayJson($data, int $code = 200)
    {
        header('Content-type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($data);
    }
}