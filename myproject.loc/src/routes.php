<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 04.09.2018
 * Time: 12:48
 */

return [
    '@^hello/(.*)$@' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '@^$@' => [\MyProject\Controllers\MainController::class, 'main'],
    '@^bye/(.*)$@' => [\MyProject\Controllers\MainController::class, 'sayBye'],
];