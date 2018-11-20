<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 04.09.2018
 * Time: 12:48
 */

return [

    '@^$@' => [\MyProject\Controllers\MainController::class, 'main'],

    '@^about$@' => [\MyProject\Controllers\AboutMeController::class, 'view'],

    '@^contact$@' => [\MyProject\Controllers\ContactsController::class, 'view'],

    '@^contact/contact-message$@' => [\MyProject\Controllers\ContactsController::class, 'sendMessage'],

    '@^category/(\d+)$@' => [\MyProject\Controllers\CategoriesController::class, 'view'],

    '@^articles/(\d+)$@' => [\MyProject\Controllers\ArticlesController::class, 'view'],

    '@^articles/(\d+)/comment$@' => [\MyProject\Controllers\ArticlesController::class, 'comment'],

    '@^articles/(\d+)/edit$@' => [\MyProject\Controllers\ArticlesController::class, 'edit'],

    '@^articles/(\d+)/delete$@' => [\MyProject\Controllers\ArticlesController::class, 'delete'],

    '@^users/login$@' => [\MyProject\Controllers\UsersController::class, 'login'],

    '@^users/logout$@' => [\MyProject\Controllers\UsersController::class, 'logout'],

    '@^users/register$@' => [\MyProject\Controllers\UsersController::class, 'signUp'],

    '@^users/(\d+)/activate/(.+)$@' => [\MyProject\Controllers\UsersController::class, 'activate'],

    '@^articles/add$@' => [\MyProject\Controllers\ArticlesController::class, 'add'],

    '@^admin/articles$@' => [\MyProject\Controllers\AdminController::class, 'lastArticles'],

    '@^admin/comments$@' => [\MyProject\Controllers\AdminController::class, 'lastComments'],

    '@^admin$@' => [\MyProject\Controllers\AdminController::class, 'view'],

    '@^tags/(\d+)$@' => [\MyProject\Controllers\TagsController::class, 'view'],

    '@^search$@' => [\MyProject\Controllers\SearchController::class, 'search'],

];