<?php

namespace Igorwanbarros\Php2Html\Form\Fields;

use Igorwanbarros\Php2Html\Form\Field;

/**
 * Class Checkbox
 * @package Igorwanbarros\Php2Html\Form\Fields
 */
class Checkbox extends Field
{

    /**
     * @var string
     */
    protected $type = 'checkbox';


    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value) {
        if ($value == 1) {
            $this->addAttribute('checked', 'checked');
        }

        return parent::setValue($value);
    }
}
