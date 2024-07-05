<?php

namespace Igorwanbarros\Php2Html\Form\Fields;

use Igorwanbarros\Php2Html\TagHtml;

/**
 * Class Radio
 * @package Igorwanbarros\Php2Html\Form\Fields
 */
class Radio extends Text
{

    /**
     * @var string
     */
    protected $type = 'radio';


    /**
     * @return $this|AbstractHtml
     */
    protected function _createFieldHtml()
    {
        $field = TagHtml::source($this->tagName)
            ->addAttributeRaw('type', $this->type)
            ->addAttributeRaw('name', $this->name)
            ->addAttributeRaw('value', $this->value);

        return $field;
    }
}