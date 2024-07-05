<?php

namespace Igorwanbarros\Php2Html\Breadcrumbs;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class BreadcrumbsView
 * @package Igorwanbarros\Php2Html\Breadcrumbs
 */
class BreadcrumbsView extends ViewAbstract
{

    /**
     * @var string
     */
    protected $template = 'templates/%s/breadcrumbs.php';

    /**
     * @type array
     */
    protected $itens = [];

    /**
     * @type bool
     */
    protected $active = false;


    /**
     * @param array $itens
     */
    public function __construct(array $itens = [])
    {
        parent::__construct();
        $this->setItens($itens);
        $this->addAttribute('class', 'breadcrumb');
    }


    public function getVars()
    {
        return ['breadcrumbs' => $this];
    }


    /**
     * @return array
     */
    public function getItens()
    {
        return $this->itens;
    }


    /**
     * @param $itens
     *
     * @return $this
     */
    public function setItens(array $itens)
    {
        $this->itens = [];

        foreach ($itens as $url => $linkName) {
            $this->addItem($url, $linkName);
        }

        return $this;
    }


    public function addItem($url, $linkName)
    {
        $this->itens[$url] = $linkName;

        $this->active = $url;

        return $this;
    }


    /**
     * @return bool|string
     */
    public function getActive()
    {
        return $this->active;
    }


    /**
     * @param string $active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }
}
