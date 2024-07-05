<?php

namespace Igorwanbarros\Php2Html\Form\Fields;

use Igorwanbarros\Php2Html\TagHtml;
use Igorwanbarros\Php2Html\Form\Field;

/**
 * Class Select
 * @package Igorwanbarros\Php2Html\Form\Fields
 */
class Select extends Field
{

    /**
     * @var string
     */
    protected $type = 'select';

    /**
     * @var string
     */
    protected $tagName = 'select';

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string
     */
    protected $defaultOption = '[selecione]';


    /**
     * @param string    $name
     * @param string    $label
     * @param array     $options
     */
    public function __construct($name, $label = '', array $options = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
    }


    /**
     * @return $this|\Igorwanbarros\Php2Html\AbstractHtml
     */
    protected function _createFieldHtml()
    {
        $field = TagHtml::source($this->tagName, $this->_renderOptions())
            ->addAttributeRaw('name', $this->name)
            ->addAttributeRaw('id', $this->getId());

        return $field;
    }


    /**
     * @return string
     */
    protected function _renderOptions()
    {
        $options = '';

        if ($this->defaultOption) {
            $options = "<option value=\"\">{$this->defaultOption}</option>";
        }

        foreach ($this->options as $value => $option) {
            $selected = $this->value == $value ? 'selected="selected"' : '';
            $options .= "<option value=\"{$value}\" {$selected}>{$option}</option>";
        }

        return $options;
    }


    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }


    /**
     * @param string $key
     *
     * @return null
     */
    public function getOption($key)
    {
        return array_key_exists($key, $this->options) ? $this->options[$key] : null;
    }


    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function addOption($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }


    /**
     * @param array $options
     *
     * @return $this
     */
    public function addOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }


    /**
     * @return string
     */
    public function getDefaultOption()
    {
        return $this->defaultOption;
    }


    /**
     * @param string $defaultOption
     *
     * @return $this
     */
    public function setDefaultOption($defaultOption)
    {
        $this->defaultOption = $defaultOption;

        return $this;
    }
}
