<?php

namespace Igorwanbarros\Php2Html\Panel;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class PanelView
 * @package Igorwanbarros\Php2Html\Panel
 */
class PanelView extends ViewAbstract
{

    /**
     * @var string
     */
    protected $template = 'templates/%s/panel.php';

    /**
     * @var string|ViewAbstract
     */
    protected $title;

    /**
     * @var string|ViewAbstract
     */
    protected $body;

    /**
     * @var string|ViewAbstract
     */
    protected $footer;

    /**
     * @var bool
     */
    protected $boxToolsRemove = false;

    /**
     * @var bool
     */
    protected $boxToolsCollapse = false;

    /**
     * @var string
     */
    protected $classPanel = ViewAbstract::PANEL_BOOTSTRAP_DEFAULT;

    /**
     * @var string
     */
    protected $classPanelHeading = 'panel-heading';

    /**
     * @var string
     */
    protected $classPanelHeadingTitle = 'panel-title';

    /**
     * @var string
     */
    protected $classPanelBody = 'panel-body';

    /**
     * @var string
     */
    protected $classPanelFooter = 'panel-footer';

    /**
     * @var bool
     */
    public $isPanelClass = true;


    /**
     * @param string|ViewAbstract $title
     * @param string|ViewAbstract $body
     * @param string|ViewAbstract $footer
     */
    public function __construct($title = null, $body = null, $footer = null)
    {
        parent::__construct();
        $this->title    = $title;
        $this->body     = $body;
        $this->footer   = $footer;
    }


    /**
     * @return array
     */
    public function getVars()
    {
        return ['panel' => $this];
    }


    /**
     * Retorna o Titulo do Painel
     * @return string|ViewAbstract retorna uma string ou null
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Seta o titulo do Painel
     * @param string|ViewAbstract $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }


    /**
     * Retorna o body (corpo) do painel
     * @return string|ViewAbstract retorna uma string ou null
     */
    public function getBody()
    {
        return $this->body;
    }


    /**
     * Seta o body (corpo) do painel
     * @param string|ViewAbstract $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }


    /**
     * Retorna o footer (rodape) do painel
     * @return string|ViewAbstract retorna uma string ou null
     */
    public function getFooter()
    {
        return $this->footer;
    }


    /**
     * Seta o footer (rodape) do painel
     * @param string|ViewAbstract  $footer
     * @return $this
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
        return $this;
    }


    /**
     * @return boolean
     */
    public function isBoxToolsCollapse()
    {
        return $this->boxToolsCollapse;
    }


    /**
     * @param boolean $boxToolsCollapse
     * @return $this
     */
    public function setBoxToolsCollapse($boxToolsCollapse)
    {
        $this->boxToolsCollapse = $boxToolsCollapse;
        return $this;
    }


    /**
     * @return boolean
     */
    public function isBoxToolsRemove()
    {
        return $this->boxToolsRemove;
    }


    /**
     * @param boolean $boxToolsRemove
     * @return $this
     */
    public function setBoxToolsRemove($boxToolsRemove)
    {
        $this->boxToolsRemove = $boxToolsRemove;
        return $this;
    }


    /**
     * Retorna a(s) classe(s) do panel
     * @return string
     */
    public function getClassPanel()
    {
        return $this->isPanelClass ? "panel $this->classPanel" : $this->classPanel;
    }


    /**
     * Define a(s) classe(s) do panel
     * @param string $class
     * @return $this
     */
    public function setClassPanel($class)
    {
        $this->classPanel = $class;

        return $this;
    }


    /**
     * Adiciona classe a div do panel
     * @param string $classPanel
     * @return $this
     */
    public function addClassPanel($classPanel)
    {
        $this->classPanel .= ' ' . $classPanel;
        return $this;
    }


    /**
     * @return string
     */
    public function getClassPanelBody()
    {
        return $this->classPanelBody;
    }


    /**
     * @param $classPanelBody
     *
     * @return $this
     */
    public function setClassPanelBody($classPanelBody)
    {
        $this->classPanelBody = $classPanelBody;
        return $this;
    }


    /**
     * @return string
     */
    public function getClassPanelFooter()
    {
        return $this->classPanelFooter;
    }


    /**
     * @param $classPanelFooter
     *
     * @return $this
     */
    public function setClassPanelFooter($classPanelFooter)
    {
        $this->classPanelFooter = $classPanelFooter;
        return $this;
    }


    /**
     * @return string
     */
    public function getClassPanelHeading()
    {
        return $this->classPanelHeading;
    }


    /**
     * @param $classPanelHeading
     *
     * @return $this
     */
    public function setClassPanelHeading($classPanelHeading)
    {
        $this->classPanelHeading = $classPanelHeading;
        return $this;
    }


    /**
     * @return string
     */
    public function getClassPanelHeadingTitle()
    {
        return $this->classPanelHeadingTitle;
    }


    /**
     * @param $classPanelHeadingTitle
     *
     * @return $this
     */
    public function setClassPanelHeadingTitle($classPanelHeadingTitle)
    {
        $this->classPanelHeadingTitle = $classPanelHeadingTitle;
        return $this;
    }
}
