<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 04.09.2018
 * Time: 12:48
 */

return [
    '@^$@' => [\MyProject\Controllers\MainController::class, 'main'],
    '@^articles/(\d+)$@' => [\MyProject\Controllers\ArticlesController::class, 'view'],
];