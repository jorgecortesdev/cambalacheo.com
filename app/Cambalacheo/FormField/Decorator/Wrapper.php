<?php

namespace Cambalacheo\FormField\Decorator;

use Illuminate\Session\Store as Session;
use Cambalacheo\FormField\Decorator\AbstractDecorator;

class Wrapper extends AbstractDecorator
{
    protected $input;

    public function build($name, array $args, Session $session)
    {
        $wrapper = $this->createWrapper($name, $session);
        $input   = $this->input->build($name, $args, $session);

        return str_replace('{{FIELD}}', $input, $wrapper);
    }

    protected function createWrapper($name, Session $session)
    {
        $wrapper        = $this->args['element'];
        $wrapperClass[] = $this->args['class'];

        $errors = $session->get('errors');
        if ($errors && $errors->has($name)) {
            $wrapperClass[] = 'has-error';
        }

        return sprintf(
            "<%s class='%s'>{{FIELD}}</%s>",
            $wrapper, implode(' ', $wrapperClass), $wrapper
        );
    }
}