<?php

namespace Igorwanbarros\Php2Html\Table;

/**
 * Class RowTableView
 * @package Igorwanbarros\Php2Html\Table
 */
class RowTableView 
{

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $attributes;

    /**
     * @var array
     */
    protected $attributesByKey = [];

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string
     */
    protected $lineLink;


    /**
     * @param array $headers
     * @param mixed $data
     */
    public function __construct(array $headers, $data)
    {
        $this->headers  = $headers;
        $this->setData($data);
    }


    /**
     * @param $header
     *
     * @return string
     */
    public function getDataValue($header)
    {
        if (strpos($header, '.') !== false) {
            $fields = explode('.', $header);
            $value = $this->data;

            foreach ($fields as $campo) {
                if (isset($value->{$campo})) {
                    $value = $value->{$campo};
                } else {
                    $value = '';
                }
            }

            return $value;
        }

        return isset($this->data->{$header}) ? $this->data->{$header} : '';
    }


    /**
     * @param $columnName
     * @param $key
     * @param $value
     * @return $this
     */
    public function addColumnAttributes($columnName, $key, $value)
    {
        if (!isset($this->attributesByKey[$columnName])) {
            $this->attributesByKey[$columnName] = '';
        }
        $this->attributesByKey[$columnName] .= " {$key}=\"{$value}\"";

        return $this;
    }

    /**
     * @param $columnName
     * @return $this
     */
    public function clearColumnAttribute($columnName)
    {
        $this->attributesByKey[$columnName] = '';

        return $this;
    }


    /**
     * @param $columnName
     * @param null $default
     * @return mixed|null
     */
    public function getColumnAttributes($columnName, $default = null)
    {
        return isset($this->attributesByKey[$columnName])
            ? $this->attributesByKey[$columnName]
            : $default;
    }


    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }


    /**
     * @param $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }


    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }


    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function addAttributes($key, $value)
    {
        $this->attributes .= "{$key}=\"{$value}\" ";

        return $this;
    }


    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @param mixed $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = is_array($data) ? (object) $data : $data;

        return $this;
    }


    /**
     * @return string
     */
    public function getLineLink()
    {
        return strpos($this->lineLink, '%s') !== false
            ? sprintf($this->lineLink, isset($this->data->id) ? $this->data->id : '')
            : $this->lineLink;
    }


    /**
     * @param string $lineLink
     *
     * @return $this
     */
    public function setLineLink($lineLink)
    {
        $this->lineLink = $lineLink;

        return $this;
    }


    public function getValueKey($key)
    {
        $value = $this->data->{$key};

        if (strpos($key, '.') !== false) {
            $fields = explode('.', $key);
            $value = $this->data;

            foreach ($fields as $campo) {
                $value = $value->{$campo};
            }
        }

        return $value;
    }
}
