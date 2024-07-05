<?php

namespace Igorwanbarros\Php2Html\Alert;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class AlertView
 * @package Igorwanbarros\Php2Html\Alert
 */
class AlertView extends ViewAbstract
{
    const BOOTSTRAP_SUCCESS = 'alert alert-success';
    const BOOTSTRAP_INFO = 'alert alert-info';
    const BOOTSTRAP_WARNING = 'alert alert-warning';
    const BOOTSTRAP_DANGER = 'alert alert-danger';

    /**
     * @var string
     */
    protected $template = 'templates/%s/alert.php';

    /**
     * @type string
     */
    protected $tagName = 'div';

    /**
     * @type string
     */
    protected $text;

    protected $dismissible = false;

    protected $textDismissible = '<span aria-hidden="true">&times;</span>';


    /**
     * @param string $text
     * @param string $class
     */
    public function __construct($text, $class = self::BOOTSTRAP_SUCCESS)
    {
        parent::__construct();
        $this->text = $text;
        $this->addAttribute('class', $class);
    }


    public function getVars()
    {
        return ['alert' => $this];
    }


    /**
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }


    /**
     * @param $tagName
     *
     * @return $this
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }


    /**
     * @param $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }


    /**
     * @return bool
     */
    public function getDismissible()
    {
        return $this->dismissible;
    }


    /**
     * @param bool $dismissible
     *
     * @return $this
     */
    public function setDismissible($dismissible)
    {
        $this->dismissible = (bool) $dismissible;

        return $this;
    }


    /**
     * @return string
     */
    public function getTextDismissible()
    {
        return $this->textDismissible;
    }


    /**
     * @param $textDismissible
     *
     * @return $this
     */
    public function setTextDismissible($textDismissible)
    {
        $this->textDismissible = $textDismissible;

        return $this;
    }
}
