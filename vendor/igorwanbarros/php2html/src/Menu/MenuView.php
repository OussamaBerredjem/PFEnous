<?php

namespace Igorwanbarros\Php2Html\Menu;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class MenuView
 * @package Igorwanbarros\Php2Html\Menu
 */
class MenuView extends ViewAbstract
{

    /**
     * @var string
     */
    protected $template     = 'templates/%s/menu.php';

    /**
     * @var array
     */
    protected $itensMenu    = [];


    /**
     * @return array
     */
    public function getVars()
    {
        return array('menu' => $this);
    }


    /**
     * @return array
     */
    public function getItensMenu()
    {
        return $this->itensMenu;
    }


    /**
     * @param string        $itemName
     * @param ItemMenu      $itemMenu
     *
     * @return $this
     */
    public function addItemMenu($itemName, ItemMenu $itemMenu)
    {
        $this->itensMenu[$itemName] = $itemMenu;

        return $this;
    }


    /**
     * @param $itemName
     *
     * @return $this
     */
    public function removeItemMenu($itemName)
    {
        if (is_array($itemName)) {
            foreach ($itemName as $item) {
                $this->removeItemMenu($item);
            }

            return $this;
        }

        if (is_scalar($itemName) && array_key_exists($itemName, $this->itensMenu)) {
            unset($this->itensMenu[$itemName]);
        }

        return $this;
    }


    /**
     * @return $this
     */
    public function clearItens()
    {
        $this->itensMenu = [];

        return $this;
    }


    /**
     * @param string   $subNivelName
     * @param ItemMenu $itemMenu
     *
     * @return $this
     */
    public function createSubNivel($subNivelName, ItemMenu $itemMenu)
    {
        $this->_setDotNotation($this->itensMenu, $subNivelName, [$itemMenu]);

        return $this;
    }


    /**
     * @param array     $array
     * @param string    $string
     * @param string    $value
     *
     * @return array
     */
    protected function _setDotNotation(array &$array, $string, $value)
    {
        $niveis = explode('.', $string);

        foreach ($niveis as $nivel)
            $array = &$array[$nivel];

        $array = $value;
        return $array;
    }


    /**
     * @param string    $subNivelName
     * @param string    $itemName
     * @param ItemMenu  $itemMenu
     *
     * @return $this
     */
    public function addItemSubNivel($subNivelName, $itemName, ItemMenu $itemMenu)
    {
        $this->_setDotNotation($this->itensMenu, $subNivelName . '.' . $itemName, $itemMenu);

        return $this;
    }


    /**
     * @param $itemName
     *
     * @return string
     */
    public function hasItemMenu($itemName)
    {
        return array_key_exists($itemName, $this->itensMenu) ? true : false;
    }


    /**
     * @return $this
     */
    public function clearItensMenu()
    {
        $this->itensMenu = [];
        return $this;
    }
}
