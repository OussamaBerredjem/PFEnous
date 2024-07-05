<?php

namespace Igorwanbarros\Php2Html\Tags;

/**
 * Class Badges
 * @package Igorwanbarros\Php2Html\Tags
 */
class BadgesView extends LabelView
{
    const BOOTSTRAP_DEFAULT = 'badge badge-default';
    const BOOTSTRAP_PRIMARY = 'badge badge-primary';
    const BOOTSTRAP_INFO = 'badge badge-info';
    const BOOTSTRAP_SUCCESS = 'badge badge-success';
    const BOOTSTRAP_WARNING = 'badge badge-warning';
    const BOOTSTRAP_DANGER = 'badge badge-danger';

    public function __construct($label, $class = self::BOOTSTRAP_DEFAULT)
    {
        parent::__construct($label, $class);
    }
}
