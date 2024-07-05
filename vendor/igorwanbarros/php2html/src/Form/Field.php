<?php

namespace Igorwanbarros\Php2Html\Form;

use Igorwanbarros\Php2Html\AbstractHtml;
use Igorwanbarros\Php2Html\TagHtml;
use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class Field
 * @package Igorwanbarros\Php2Html\Form
 */
abstract class Field extends ViewAbstract
{

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var null|string
     */
    protected $value;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var null|string
     */
    protected $id;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $tagName  = 'input';

    /**
     * @var int|string
     */
    protected $size     = 4;

    /**
     * @var string
     */
    protected $rules;


    /**
     * @param string        $name
     * @param string        $label
     * @param null|string   $value
     */
    public function __construct($name, $label = '', $value = null)
    {
        parent::__construct();
        $this->name     = $name;
        $this->value    = $value;
        $this->label    = $label;
    }


    /**
     * @param string        $name
     * @param string        $label
     * @param null|string   $value
     *
     * @return $this
     */
    public static function create($name, $label = '', $value = null)
    {
        return new static($name, $label, $value);
    }


    /**
     * @return string
     */
    public function render($template = null)
    {
        if ($template) {
            return parent::render($template);
        }

        $field = $this->_createFieldHtml();

        $this->_addAttributesFieldHtml($field);

        return $field->render();
    }


    /**
     * @return $this|AbstractHtml
     */
    protected function _createFieldHtml()
    {
        $field = TagHtml::source($this->tagName)
            ->addAttributeRaw('type', $this->type)
            ->addAttributeRaw('name', $this->name)
            ->addAttributeRaw('id', $this->getId())
            ->addAttributeRaw('value', $this->value);

        return $field;
    }


    /**
     * @param AbstractHtml $field
     */
    protected function _addAttributesFieldHtml(AbstractHtml $field)
    {
        if (is_array($this->attributes) && count($this->attributes) > 0) {
            foreach ($this->attributes as $key => $value) {
                $field->addAttributeRaw($key, $value);
            }
        }
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }


    /**
     * @return null|string
     */
    public function getId()
    {
        if ($this->id == null) {
            $this->id = $this->name;
        }

        return $this->id;
    }


    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }


    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    /**
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }


    /**
     * @return int|string
     */
    public function getSize()
    {
        return $this->size;
    }


    /**
     * @param int|string $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }


    /**
     * @return string
     */
    public function getRules()
    {
        return $this->rules;
    }


    /**
     * @param string $rule
     *
     * @return $this
     */
    public function addRule($rule)
    {
        $this->rules .= $rule;

        return $this;
    }

    public function setRule($rules)
    {
        $this->rules = $rules;

        return $this;
    }


    public function setLabelRequired($required = true)
    {
        if ($required) {
            $requiredXs = '<span class="hidden-sm hidden-md hidden-lg label__required">*</span>';
            $required = '<sup class="hidden-xs label__required">*obrigatório</sup>';
            return $this->setLabel($this->getLabel() . $requiredXs . $required);
        }

        $label = $this->getLabel();

        if (($pos = strpos($label, '<')) !== false) {
            $label = substr($label, 0, $pos);
            return $this->setLabel($label);
        }

        return $this;
    }


    /**
     * @param TagHtml $field
     *
     * @return TagHtml
     */
    protected function _setPersonalizationAttribute(TagHtml $field)
    {
        if (array_key_exists($class = get_called_class(), static::$personalizations)) {
            foreach (static::$personalizations[$class] as $key => $value) {
                $field->addAttributeRaw($key, $value);
            }
        }

        return $field;
    }
}
