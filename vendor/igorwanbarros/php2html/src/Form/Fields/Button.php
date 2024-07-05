<?php

namespace Igorwanbarros\Php2Html\Form\Fields;

use Igorwanbarros\Php2Html\Form\Field;
use Igorwanbarros\Php2Html\TagHtml;

/**
 * Class Button
 * @package Igorwanbarros\Php2Html\Form\Fields
 */
class Button extends Field
{
    /**
     * @var null|string
     */
    protected $type     = 'button';

    /**
     * @var string
     */
    protected $tagName  = 'button';


    /**
     * @param string $name
     * @param null   $type
     * @param null   $value
     */
    public function __construct($name, $type = null, $value = null)
    {
        parent::__construct($name, null, $value);
        $this->type = $type != null ? $type : $this->type;
    }


    /**
     * @return $this|\Igorwanbarros\Php2Html\AbstractHtml
     */
    protected function _createFieldHtml()
    {
        $field = TagHtml::source($this->tagName, $this->value ? $this->value : $this->name)
            ->addAttributeRaw('type', $this->type)
            ->addAttributeRaw('name', $this->name);

        return $this->_setPersonalizationAttribute($field);
    }
}
