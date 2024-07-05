<?php

namespace Igorwanbarros\Php2Html\Accordion;

use Igorwanbarros\Php2Html\Helpers;
use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class AccordionView
 * @package Igorwanbarros\Php2Html\Accordion
 */
class AccordionView extends ViewAbstract
{

    /**
     * @var string
     */
    protected $template = 'templates/%s/accordion.php';

    /**
     * @type array
     */
    protected $titles = [];

    /**
     * @type array
     */
    protected $contents = [];

    /**
     * @type bool
     */
    protected $active;


    /**
     * @param array $titles
     * @param array $contents
     */
    public function __construct(array $titles = [], array $contents = [])
    {
        parent::__construct();
        $this->setTitles($titles);
        $this->setContents($contents);

        $this->addAttribute('class', 'panel-group')
            ->addAttribute('role', 'tablist')
            ->addAttribute('aria-multiselectable', 'true');
    }


    /**
     * @return array
     */
    public function getVars()
    {
        return ['accordion' => $this];
    }


    /**
     * @return array
     */
    public function getTitles()
    {
        return $this->titles;
    }


    /**
     * @param $titles
     *
     * @return $this
     */
    public function setTitles(array $titles)
    {
        $this->titles = [];

        foreach ($titles as $titleKey => $title) {
            $this->addTitle($titleKey, $title);
        }

        return $this;
    }


    /**
     * @param $titleKey
     * @param $title
     *
     * @return AccordionView
     */
    public function addTitle($titleKey, $title)
    {
        if (is_array($titleKey)) {
            return $this->setTitles($titleKey);
        }

        return $this->_preparedTitle($titleKey, $title);
    }



    /**
     * @return array
     */
    public function getContents()
    {
        return $this->contents;
    }


    /**
     * @param $contents
     *
     * @return $this
     */
    public function setContents(array $contents)
    {
        $this->titles = [];

        foreach ($contents as $titleContent => $content) {
            $this->addTitle($titleContent, $content);
        }

        return $this;
    }


    /**
     * @param $titleContent
     * @param $content
     *
     * @return AccordionView
     */
    public function addContent($titleContent, $content)
    {
        if (is_array($titleContent)) {
            return $this->setContents($titleContent);
        }

        return $this->_preparedContent($titleContent, $content);
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
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }


    /**
     * @param $active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }
}
