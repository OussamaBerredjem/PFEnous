<?php

namespace Igorwanbarros\Php2Html\Pagination;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class PaginationView
 * @package Igorwanbarros\Php2Html\Pagination
 */
class PaginationView extends ViewAbstract
{

    /**
     * @var string
     */
    protected $template = 'templates/%s/pagination.php';
}
