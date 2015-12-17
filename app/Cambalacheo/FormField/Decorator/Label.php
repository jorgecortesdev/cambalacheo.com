<?php

namespace Cambalacheo\FormField\Decorator;

use Form;
use Illuminate\Session\Store as Session;
use Cambalacheo\FormField\Decorator\AbstractDecorator;

class Label extends AbstractDecorator
{
    protected $input;

    public function build($name, array $args, Session $session)
    {
        $label = $this->createLabel($name, $args);
        return $label . $this->input->build($name, $args, $session);
    }

    protected function createLabel($name, $args)
    {
        $label = array_get($this->args, 'label');

        is_null($label) && $label = $this->prettifyFieldName($name) . ': ';

        return $label ? Form::label($name, $label, ['class' => 'control-label']) : '';
    }

    protected function prettifyFieldName($name)
    {
        return ucwords(preg_replace('/(?<=\w)(?=[A-Z])/', " $1", $name));
    }
}