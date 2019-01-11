<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/2/2018
 * Time: 6:06 PM
 */

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Categories\Category;
use MyProject\Models\Pagination\Pagination;
use MyProject\View\View;

class CategoriesController extends AbstractController
{
    public function view(int $categoryId)
    {
        // Category
        $category = Category::getById($categoryId);

        // Article by category data
        $articles = Article::getByCategoryId($categoryId);

        // Render category.php view
        $this->view->renderHtml('categories/category.php', [
                'category' => $category,
                'articles' => $articles,
            ]
        );
    }
}