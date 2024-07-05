<?php
namespace Igorwanbarros\Php2Html;

/**
 * Class ViewAbstract
 * @package Igorwanbarros\Php2Html
 */
abstract class ViewAbstract
{
    const PANEL_BOOTSTRAP_DEFAULT = 'panel-default';
    const PANEL_BOOTSTRAP_SUCCESS = 'panel-success';
    const PANEL_BOOTSTRAP_PRIMARY = 'panel-primary';
    const PANEL_BOOTSTRAP_WARNING = 'panel-warning';
    const PANEL_BOOTSTRAP_DANGER = 'panel-danger';
    const PANEL_SEMANTIC_DEFAULT = '';
    const PANEL_SEMANTIC_SUCCESS = 'green';
    const PANEL_SEMANTIC_PRIMARY = 'blue';
    const PANEL_SEMANTIC_WARNING = 'yellow';
    const PANEL_SEMANTIC_DANGER = 'red';
    const FRONT_BOOTSTRAP = 'bootstrap';
    const FRONT_SEMANTIC = 'semantic';
    const TABLE_SEMANTIC = 'ui striped selectable table';
    const TABLE_BOOTSTRAP = 'table table-striped table-hover';

    /**
     * @var string
     */
    protected $output;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var array
     */
    protected $vars;

    /**
     * @var string
     */
    protected $front = self::FRONT_BOOTSTRAP;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var array
     */
    protected static $personalizations = [];


    public function __construct()
    {
        $this->_initPersonalizationByClass();
    }


    protected function _initPersonalizationByClass()
    {
        if (array_key_exists($class = get_called_class(), self::$personalizations)) {
            return;
        }

        self::$personalizations[$class] = [];
    }


    /**
     * @return array
     */
    public static function getPersonalizations()
    {
        return array_key_exists($class = get_called_class(), self::$personalizations)
            ? self::$personalizations[$class]
            : [];
    }


    /**
     * @param array $personalizations
     */
    public static function setPersonalizations(array $personalizations)
    {
        self::$personalizations = array_merge(self::$personalizations, $personalizations);
    }


    /**
     * @param $propertie
     * @param $value
     */
    public static function addPersonalization($propertie, $value)
    {
        self::$personalizations[get_called_class()][$propertie] = $value;
    }


    protected function _personalizeView()
    {
        $class = get_called_class();

        if (!array_key_exists($class, self::$personalizations)) {
            return;
        }

        $attributes = self::$personalizations[$class];

        foreach ($attributes as $key => $value) {
            $key = ucwords(str_replace(['_', '-'], ' ', $key));
            $key = lcfirst(str_replace(' ', '', $key));

            if (!property_exists($class, $key)) {
                continue;
            }

            $this->{$key} = $value;
        }
    }


    /**
     * @return $this
     */
    public static function source()
    {
        $args   = func_get_args();
        $class  = new \ReflectionClass(get_called_class());

        return $class->newInstanceArgs($args);
    }


    /**
     * @param string $method
     * @param array $arguments
     *
     * @return $this|mixed
     */
    public function __call($method, $arguments)
    {
        if ($this->_callSetAttributes($method, $arguments)) {
            return $this;
        }

        if ($getAttributes = $this->_callGetAttributes($method)) {
            return $getAttributes;
        }
    }


    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath ? $this->basePath : __DIR__ . '/';
    }


    /**
     * @param string $basePath
     *
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }


    /**
     * @return array
     */
    public function getVars()
    {
        return is_array($this->vars) ? $this->vars : ['this' => $this];
    }


    /**
     * @param array $vars
     *
     * @return $this
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
        return $this;
    }


    /**
     * @param null|string $template
     *
     * @return string
     * @throws \Exception
     */
    public function render($template = null)
    {
        $this->_personalizeView();
        try {
            ob_start();

            $template = $template ? $template : $this->getBasePath() . $this->getTemplate();

            if (!file_exists($template)) {
                throw new \Exception("O caminho do template '{$template}' informado não foi encontrado :(");
            }

            extract($this->getVars(), EXTR_OVERWRITE);

            include $template;

            $this->output = ob_get_contents();

            ob_end_clean();
        } catch (\Exception $e) {
            $this->output = "<div class=\"error__view\">" .
                    "Não foi possível exibir a view solicitada.<br />" .
                    "{$e->getMessage()}" .
                "</div>";
        }

        return $this->output;
    }


    /**
     * @return string
     * @throws \Exception
     */
    public function __toString()
    {
        return $this->render();
    }


    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }


    /**
     * @param string $output
     *
     * @return $this
     */
    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }


    /**
     * @return string
     */
    public function getTemplate()
    {
        if (strpos($this->template, '%s') !== false)
            $this->template = sprintf($this->template, $this->front);

        return $this->template;
    }


    /**
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }


    /**
     * Retorna qual front o elemento esta utilizando
     *
     * @return string
     */
    public function getFront()
    {
        return $this->front;
    }


    /**
     * Definir qual front o elemento vai utilizar
     *
     * @param string $front
     *
     * @return $this
     */
    public function setFront($front)
    {
        $this->front = $front;

        return $this;
    }


    /**
     * @return array|string
     */
    public function getAttributes()
    {
        return $this->attributes;
    }


    /**
     * @param $key
     *
     * @return null
     */
    public function getAttribute($key)
    {
        return array_key_exists($key, $this->attributes) ? $this->attributes[$key] : null;
    }


    /**
     * @return string
     */
    public function renderAttributes()
    {
        $string = '';

        if (is_array($this->attributes)) {
            foreach ($this->attributes as $key => $value) {
                $string .= " $key=\"$value\"";
            }
        }

        return $string;
    }


    /**
     * @param $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }


    /**
     * @param string|array  $key
     * @param string|null   $value
     *
     * @return $this
     */
    public function addAttribute($key, $value = null)
    {
        if (is_array($key)) {
            return $this->setAttributes($key);
        }

        $key = Helpers::camelCase($key);

        if (is_array($this->attributes) && array_key_exists($key, $this->attributes)) {
            $this->attributes[$key] .= " $value";

            return $this;
        }

        $this->attributes[$key] = $value;

        return $this;
    }



    private function _callGetAttributes($method)
    {
        $key = Helpers::camelCase(str_replace(['get', 'attribute', 'Attribute'], '', $method));
        $method = strtolower($method);

        if (strpos($method, 'attribute') === false &&
            strpos($method, 'get') === false) {
            return false;
        }


        if (!array_key_exists($key, $this->attributes)) {
            return false;
        }

        return $this->attributes[$key];
    }


    private function _callSetAttributes($method, $arguments)
    {
        $key = str_replace(['set', 'attribute', 'Attribute'], '', $method);
        $method = strtolower($method);

        if (strpos($method, 'attribute') === false &&
            strpos($method, 'set') === false
        ) {
            return false;
        }

        if (!isset($arguments[0])) {
            return false;
        }

        return $this->addAttribute($key, $arguments[0]);
    }
}
