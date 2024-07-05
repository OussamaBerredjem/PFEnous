<?php
namespace Igorwanbarros\Php2Html;


abstract class AbstractHtml
{
    private $notEndTag      = [
        'input'     => 'input',
        //''    => '',
    ];

    protected $attributes   = [];
    protected $output       = '';


    abstract public function render();


    public function __toString()
    {
        if ($this->output instanceof AbstractHtml)
            $this->output = $this->render();

        if ($this->output == '')
            $this->output = $this->render();

        return $this->output;
    }


    public function getAttributes()
    {
        return $this->attributes;
    }


    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }


    public function addAttributeRaw($key, $value)
    {
        if (is_array($this->attributes) && sizeof($this->attributes) > 0)
            return $this->addAttribute($key, $value);

        if (is_array($this->attributes))
            $this->attributes = '';

        $this->attributes .= "{$key}=\"{$value}\" ";

        return $this;
    }


    public function tag($tagName, $html)
    {
        $endTagName = array_key_exists($tagName, $this->notEndTag) ? '' : '</' . $tagName . '>';
        $tagName    = '<' . $tagName;

        if (is_array($this->attributes))
            foreach ($this->attributes as $key => $value)
                $tagName .= ' ' . $key . '="' . $value . '"';

        if (is_string($this->attributes))
            $tagName .= ' ' . $this->attributes;


        return $tagName . '>' . $html . $endTagName;
    }
}
