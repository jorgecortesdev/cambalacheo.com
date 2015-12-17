<?php

namespace Cambalacheo\FormField\Decorator;

use Illuminate\Session\Store as Session;
use Cambalacheo\FormField\Decorator\AbstractDecorator;

class Error extends AbstractDecorator
{
    protected $input;

    public function build($name, array $args, Session $session)
    {
        $input   = $this->input->build($name, $args, $session);
        $input  .= $this->createErrorBlock($name, $session);

        return $input;
    }

    protected function createErrorBlock($name, Session $session)
    {
        $errors = $session->get('errors');

        $class = $this->args['class'];

        return $errors && $errors->has($name)
            ? "<span class=\"{$class}\">* {$errors->first($name)}</span>"
            : '';
    }
}