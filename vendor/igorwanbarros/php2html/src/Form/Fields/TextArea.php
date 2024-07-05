<?php

namespace Igorwanbarros\Php2Html\Form\Fields;

use Igorwanbarros\Php2Html\Form\Field;
use Igorwanbarros\Php2Html\TagHtml;

/**
 * Class TextArea
 * @package Igorwanbarros\Php2Html\Form\Fields
 */
class TextArea extends Field
{

    /**
     * @var string
     */
    protected $type     = '';

    /**
     * @var string
     */
    protected $tagName  = 'textarea';


    /**
     * @return $this|\Igorwanbarros\Php2Html\AbstractHtml
     */
    protected function _createFieldHtml()
    {
        $field = TagHtml::source($this->tagName, $this->value)
            ->addAttributeRaw('name', $this->name)
            ->addAttributeRaw('id', $this->getId());

        return $field;
    }
}