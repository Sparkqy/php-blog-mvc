<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 28.01.2019
 * Time: 18:39
 */

return [

    '~^articles/(\d+)$~' => [\MyProject\Controllers\Api\ArticlesApiController::class, 'view'],

];