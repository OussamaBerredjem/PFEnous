<?php

namespace Igorwanbarros\Php2Html\Form;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class Form
 * @package Igorwanbarros\Php2Html\Form
 */
class FormView extends ViewAbstract
{

    /**
     * @var string
     */
    protected $template = 'templates/%s/form.php';

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $fields;


    /**
     * @param string $action
     * @param string $method
     * @param array  $attributes
     */
    public function __construct($action = '', $method = 'GET', array $attributes = [])
    {
        parent::__construct();
        $this->action       = $action;
        $this->method       = $method;
        $this->attributes   = $attributes;

        $this->toStart();
    }


    public function toStart() {}


    /**
     * @return array
     */
    public function getVars()
    {
        return ['form' => $this];
    }


    /**
     * @param $data
     *
     * @return $this
     */
    public function fill($data)
    {
        if (is_array($data))
            $this->_fillArray($data);


        if (is_object($data))
            $this->_fillObject($data);

        return $this;
    }


    /**
     * @param $data
     */
    protected function _fillArray($data)
    {
        foreach ($data as $key => $value) {
            if (!array_key_exists($key, $this->fields)) {
                continue;
            }

            $this->fields[$key]->setValue($value);
        }
    }


    /**
     * @param $data
     */
    protected function _fillObject($data)
    {
        foreach ($this->fields as $name => $field) {
            if (isset($data->{$name})) {
                $field->setValue($data->{$name});
            }
        }
    }


    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * @param $action
     *
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }


    /**
     * @param $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }


    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }


    /**
     * @param $name
     *
     * @return null|Field
     */
    public function getField($name)
    {
        return array_key_exists($name, $this->fields) ? $this->fields[$name] : null;
    }


    /**
     * @param Field         $fields
     * @param null|string   $name
     *
     * @return $this
     */
    public function addField(Field $fields, $name = null)
    {
        $name = $name ?: $fields->getName();
        $this->fields[$name] = $fields;

        return $this;
    }
}
