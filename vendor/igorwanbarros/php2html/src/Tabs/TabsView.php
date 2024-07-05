<?php

namespace Igorwanbarros\Php2Html\Tabs;

use Igorwanbarros\Php2Html\Helpers;
use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class TabsView
 * @package Igorwanbarros\Php2Html\Tabs
 */
class TabsView extends ViewAbstract
{
    const BOOTSTRAP_TABS = 'nav-tabs';
    const BOOTSTRAP_PILLS = 'nav-pills';
    const BOOTSTRAP_JUSTIFIED = 'nav-justified';

    /**
     * @var string
     */
    protected $template = 'templates/%s/tabs.php';

    /**
     * @var array
     */
    protected $titles;

    /**
     * @var array
     */
    protected $contents;

    /**
     * @var string
     */
    protected $class = self::BOOTSTRAP_TABS;

    /**
     * @var bool|string
     */
    protected $active = false;

    /**
     * @var array
     */
    protected $keyContents = [];


    /**
     * @param array $titles
     * @param array $contents
     */
    public function __construct(array $titles = [], array $contents = [])
    {
        parent::__construct();
        $this->setTitles($titles);
        $this->setContents($contents);
    }


    /**
     * @return array
     */
    public function getVars()
    {
        return ['tabs' => $this];
    }


    /**
     * @return array
     */
    public function getContents()
    {
        return $this->contents;
    }


    /**
     * @param array $contents
     *
     * @return $this
     */
    public function setContents(array $contents)
    {
        foreach ($contents as $name => $content) {
            $this->_preparedContent($name, $content);
        }

        return $this;
    }


    /**
     * @param string|array $name
     * @param string|null  $content
     *
     * @return $this
     */
    public function addContent($name, $content = null)
    {
        if (is_array($name)) {
            return $this->setContents($name);
        }

        return $this->_preparedContent($name, $content);
    }


    /**
     * @return array
     */
    public function getTitles()
    {
        return $this->titles;
    }


    /**
     * @param array $titles
     *
     * @return $this
     */
    public function setTitles(array $titles)
    {
        foreach ($titles as $name => $title) {
            $this->_preparedTitle($name, $title);
        }

        return $this;
    }


    /**
     * @param string|array  $name
     * @param string|null   $title
     *
     * @return $this
     */
    public function addTitle($name, $title = null)
    {
        if (is_array($name)) {
            return $this->setTitles($name);
        }

        return $this->_preparedTitle($name, $title);
    }


    /**
     * @param string|int    $name
     * @param string        $title
     *
     * @return $this
     */
    protected function _preparedTitle($name, $title)
    {
        $name = is_int($name) ? $title : $name;
        $name = Helpers::normalize($name);
        $name = strtolower(str_replace(' ', '-', $name));

        if (!$this->active) {
            $this->active = $name;
        }

        $this->titles[$name] = $title;

        return $this;
    }


    /**
     * @param string|int $titleName
     * @param string     $content
     *
     * @return $this
     */
    protected function _preparedContent($titleName, $content)
    {
        $titleName = is_int($titleName) ? $content : $titleName;
        $titleName = Helpers::normalize($titleName);
        $titleName = strtolower(str_replace(' ', '-', $titleName));

        $this->contents[$titleName] = $content;

        return $this;
    }


    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }


    /**
     * @param $class
     *
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;
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
