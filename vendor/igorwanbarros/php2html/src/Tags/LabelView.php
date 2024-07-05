<?php

namespace Igorwanbarros\Php2Html\Tags;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class LabelView
 * @package Igorwanbarros\Php2Html\Tags
 */
class LabelView extends ViewAbstract
{
    const BOOTSTRAP_DEFAULT = 'label label-default';
    const BOOTSTRAP_PRIMARY = 'label label-primary';
    const BOOTSTRAP_INFO = 'label label-info';
    const BOOTSTRAP_SUCCESS = 'label label-success';
    const BOOTSTRAP_WARNING = 'label label-warning';
    const BOOTSTRAP_DANGER = 'label label-danger';

    /**
     * @var string
     */
    protected $template = 'templates/%s/label.php';

    /**
     * @var string
     */
    protected $tagName = 'span';

    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $label;


    public function __construct($label, $class = self::BOOTSTRAP_DEFAULT)
    {
        parent::__construct();
        $this->label = $label;
        $this->class = $class;
    }


    public function getVars()
    {
        return ['label' => $this];
    }


    public function getLabel()
    {
        return $this->label;
    }


    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }


    public function getTagName()
    {
        return $this->tagName;
    }


    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
        return $this;
    }


    public function getClass()
    {
        return $this->class;
    }


    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
}