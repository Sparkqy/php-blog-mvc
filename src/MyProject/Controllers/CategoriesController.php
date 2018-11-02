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
        $category = Category::getById($categoryId);
        $this->view->setExtraVars('category', $category);
        $articlesAll = Article::getByCategoryId($categoryId);

        if ($articlesAll === null)
        {
            $this->view->renderHtml(
                'categories/category.php', [
                    'error' => 'По данной категории еще нет статей.',
                    'articles' => null]
            );
            return;
        }

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $articlesCount = count($articlesAll);

        if ($articlesCount > 0)
        {
            $pagination = new Pagination($articlesCount, $page);
            $articles = Article::getPaginationCategoryId($categoryId, $page);
        }

        $this->view->renderHtml('categories/category.php', [
            'articles' => $articles,
            'pagination' => $pagination]
        );
    }
}