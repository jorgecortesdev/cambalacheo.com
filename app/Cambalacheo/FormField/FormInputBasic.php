<?php

namespace Cambalacheo\FormField;

use Form, Config;
use Cambalacheo\FormField\Buildable;
use Illuminate\Session\Store as Session;

class FormInputBasic implements Buildable
{
    public function build($name, array $args, Session $session)
    {
        $type = array_get($args, 'type') ?: $this->guessInputType($name);

        $html = $this->createInput($type, $args, $name);

        return $html;
    }

    protected function createInput($type, $args, $name)
    {
        $args = array_merge(['class' => 'form-control'], $args);

        return $type == 'password'
            ? Form::password($name, $args)
            : Form::$type($name, null, $args);
    }

    protected function guessInputType($name)
    {
        $types = Config::get('cambalacheo-formfield.commonInputsLookup');

        return array_get($types, $name) ?: 'text';
    }
}