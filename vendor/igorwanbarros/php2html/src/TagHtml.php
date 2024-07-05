<?php

namespace Igorwanbarros\Php2Html;

class TagHtml extends  AbstractHtml
{
    protected $texto;
    protected $tagName;


    public function __construct($tagName, $texto = '', $attributes = '')
    {
        $this->attributes    = $attributes;
        $this->texto        = $texto;
        $this->tagName      = $tagName;

        if ($this->texto instanceof AbstractHtml)
            $this->texto = $this->texto->render();
    }


    public static function source($tagName, $texto = '', $attributes = '')
    {
        $static = new static($tagName, $texto, $attributes);

        return $static;
    }


    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }


    public function render()
    {
        return $this->tag($this->tagName, $this->texto);
    }
}
