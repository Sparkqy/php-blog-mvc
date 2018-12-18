<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/4/2018
 * Time: 6:06 PM
 */

namespace MyProject\Models\Pagination;

use MyProject\Models\Buttons\Button;

class Pagination
{
    public $buttons = [];
    public $itemsPerPage = 6;

    public function __construct(int $itemsCount, int $currentPage)
    {
        /** @var int $currentPage */
        if (!$currentPage) {
            return;
        }

        /** @var int $pagesCount
         * @var int $itemsCount
         * @var int $itemsPerPage
         */
        $pagesCount = ceil($itemsCount / $this->itemsPerPage);

        if ($pagesCount == 1) {
            return;
        }

        /** @var int $currentPage */
        if ($currentPage > $pagesCount) {
            $currentPage = $pagesCount;
        }

        $this->buttons[] = new Button($currentPage - 1, $currentPage > 1, '< Prev');

        for ($i = 1; $i <= $pagesCount; $i++) {
            $active = $currentPage != $i;
            $this->buttons[] = new Button($i, $active);
        }

        $this->buttons[] = new Button($currentPage + 1, $currentPage < $pagesCount, 'Next >');
    }
}