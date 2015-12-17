<?php

namespace Cambalacheo\FormField\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cambalacheo\FormField\FormField
 */
class FormFieldFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'formfield'; }

}