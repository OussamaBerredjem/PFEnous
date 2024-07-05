<?php

namespace Igorwanbarros\Php2Html\Form\Fields;

use Igorwanbarros\Php2Html\Form\Field;
use Igorwanbarros\Php2Html\TagHtml;

/**
 * Class Html
 * @package Igorwanbarros\Php2Html\Form\Fields
 */
class Html extends Field
{

    /**
     * @var string
     */
    protected $type = 'hidden';

    /**
     * @var string
     */
    protected $texto;


    /**
     * @param string $name
     * @param string $tagName
     * @param string $texto
     */
    public function __construct($name, $tagName, $texto = '')
    {
        $this->tagName = $tagName;
        $this->texto   = $texto;
        $this->name    = $name;
    }


    /**
     * @return TagHtml
     */
    protected function _createFieldHtml()
    {
        $field = TagHtml::source($this->tagName, $this->texto);

        return $field;
    }
}
