<?php

namespace Cambalacheo\FormField\Decorator;

use Illuminate\Session\Store as Session;

class Counter extends AbstractDecorator
{
    public function build($name, array $args, Session $session)
    {
        $wrapper = $this->createWrapper();
        $input   = $this->input->build($name, $args, $session);
        $input  .= $this->createCounter($name, $args);

        return str_replace('{{FIELD}}', $input, $wrapper);
    }

    protected function createWrapper()
    {
        $wrapper      = $this->args['wrapper']['element'];
        $wrapperClass = $this->args['wrapper']['class'];

        return sprintf(
            "<%s class='%s'>{{FIELD}}</%s>",
            $wrapper, $wrapperClass, $wrapper
        );
    }

    protected function createCounter($name, array $args)
    {
        $max   = $this->args['max'];
        $class = $this->args['class'];
        return sprintf(
            "<div class='%s'><span id='counter-%s'>0</span>/%d</div>",
            $class, $name, $max
        );;
    }
}