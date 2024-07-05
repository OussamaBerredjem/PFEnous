<?php

namespace Igorwanbarros\Php2Html\Table;

use Igorwanbarros\Php2Html\ViewAbstract;

/**
 * Class TableView
 * @package Igorwanbarros\Php2Html\Table
 */
class TableView extends ViewAbstract
{

    /**
     * @var string
     */
    protected $template         = 'templates/%s/table.php';

    /**
     * @var array
     */
    protected $headers          = [];

    /**
     * @var array
     */
    protected $callback         = [];

    /**
     * @var string
     */
    protected $emptyList        = 'Esta listagem está vazia';

    /**
     * @var bool|string
     */
    protected $lineLink         = false;

    /**
     * @var string
     */
    protected $classTable       = ViewAbstract::TABLE_BOOTSTRAP;

    /**
     * @var mixed
     */
    protected $collection;

    /**
     * @var string
     */
    protected $footer;

    /**
     * @var string
     */
    protected $classThead;

    /**
     * @var string
     */
    protected $classTfooter;

    /**
     * @var string
     */
    protected $classTd;

    /**
     * @var mixed
     */
    protected $paginator;


    /**
     * @param array         $headers
     * @param null|mixed    $collection
     */
    public function __construct(array $headers, $collection = null)
    {
        parent::__construct();
        $this->headers = $headers;
        $this->setCollection($collection);
    }


    public function checkHeader($header = 'id', $begin = true)
    {
        $check = '<input type="checkbox" class="check-all" />';

        unset($this->headers[$header]);
        return $this->addHeader($header, $check, $begin);
    }


    /**
     * @param $row
     *
     * @return RowTableView
     */
    public function getRow($row)
    {
        $row = new RowTableView($this->headers, $row);
        $row->setLineLink($this->lineLink);

        foreach ($this->callback as $callback) {
            $callback($row);
        }

        return $row;
    }


    /**
     * @param callable $callback
     *
     * @return $this
     */
    public function callback(callable $callback)
    {
        $this->callback[] = $callback;

        return $this;
    }


    /**
     * @return array
     */
    public function getVars()
    {
        return ['table' => $this];
    }


    /**
     * @return array
     */
    public function getCollection()
    {
        return $this->collection ?: [];
    }


    /**
     * @param mixed $collection
     *
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }


    /**
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
    }


    /**
     * @param $footer
     *
     * @return $this
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }


    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }


    /**
     * @param string    $key
     * @param string    $value
     * @param bool      $begin
     *
     * @return $this
     */
    public function addHeader($key, $value, $begin = false)
    {
        if ($begin) {
            $headers[$key] = $value;
            $this->headers = array_merge($headers, $this->headers);
        } else {
            $this->headers[$key] = $value;
        }

        return $this;
    }


    /**
     * @param array $headers
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
    public function getCallback()
    {
        return $this->callback;
    }


    /**
     * @param array $callback
     *
     * @return $this
     */
    public function setCallback(array $callback)
    {
        $this->callback = $callback;

        return $this;
    }


    /**
     * @return string
     */
    public function getEmptyList()
    {
        return $this->emptyList;
    }


    /**
     * @param string $emptyList
     *
     * @return $this
     */
    public function setEmptyList($emptyList)
    {
        $this->emptyList = $emptyList;

        return $this;
    }


    /**
     * @return bool|string
     */
    public function getLineLink()
    {
        return $this->lineLink;
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


    /**
     * @return string
     */
    public function getClassTable()
    {
        return $this->classTable;
    }


    /**
     * @param string $classTable
     *
     * @return $this
     */
    public function setClassTable($classTable)
    {
        $this->classTable = $classTable;

        return $this;
    }


    /**
     * @return string
     */
    public function getClassThead()
    {
        return $this->classThead;
    }


    /**
     * @param string $classThead
     *
     * @return $this
     */
    public function setClassThead($classThead)
    {
        $this->classThead = $classThead;

        return $this;
    }


    /**
     * @return string
     */
    public function getClassTfooter()
    {
        return $this->classTfooter;
    }


    /**
     * @param string $classTfooter
     *
     * @return $this
     */
    public function setClassTfooter($classTfooter)
    {
        $this->classTfooter = $classTfooter;

        return $this;
    }


    /**
     * @return string
     */
    public function getClassTd()
    {
        return $this->classTd;
    }


    /**
     * @param string $classTd
     *
     * @return $this
     */
    public function setClassTd($classTd)
    {
        $this->classTd = $classTd;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getPaginator()
    {
        return $this->paginator;
    }


    /**
     * @param mixed $paginator
     *
     * @return $this
     */
    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;

        return $this;
    }
}
