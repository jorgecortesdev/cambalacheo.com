<?php

namespace Cambalacheo\FormField;

use Illuminate\Session\Store as Session;

interface Buildable
{
    public function build($name, array $args, Session $session);
}