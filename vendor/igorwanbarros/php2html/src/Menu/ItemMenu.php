<?php

namespace Igorwanbarros\Php2Html\Menu;

/**
 * Class ItemMenu
 * @package Igorwanbarros\Php2Html\Menu
 */
class ItemMenu 
{

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $texto;

    /**
     * @var string
     */
    protected $href;


    /**
     * @param string $texto
     * @param string $href
     * @param string $iconClass
     */
    public function __construct($texto, $href = '#', $iconClass = '')
    {
        $this->texto = $texto;
        $this->href  = $href;
        $this->setIcon($iconClass);
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('<a href="%s">%s<span>%s</span></a>', $this->href, $this->icon, $this->texto);
    }


    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }


    /**
     * @param string $iconClass
     *
     * @return $this
     */
    public function setIcon($iconClass)
    {
        $this->icon = $iconClass;

        return $this;
    }


    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }


    /**
     * @param string $href
     *
     * @return $this
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }


    /**
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }


    /**
     * @param string $texto
     *
     * @return $this
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }
}
