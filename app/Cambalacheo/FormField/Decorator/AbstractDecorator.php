<?php

namespace Cambalacheo\FormField\Decorator;

use Config;
use Cambalacheo\FormField\Buildable;

abstract class AbstractDecorator implements Buildable
{
    /**
     * Buildable object
     *
     * @var Cambalacheo\FormField\Buildable
     */
    protected $input;

    /**
     * Class arguments
     *
     * @var array
     */
    protected $args = [];

    /**
     * Constructor
     *
     * @param Cambalacheo\FormField\Buildable $input
     */
    public function __construct(Buildable $input)
    {
        $this->input = $input;

        $key  = strtolower(class_basename($this));
        $args = Config::get("cambalacheo-formfield.decorator.{$key}") ?: [];
        $this->processArguments($args);
    }

    /**
     * Set the class arguments
     *
     * @param array $args
     */
    public function setArguments(array $args)
    {
        $this->processArguments($args);
    }

    /**
     * Process arguments or initialize defaults
     *
     * @param  array $args
     * @return void
     */
    protected function processArguments(array $args = [])
    {
        foreach ($args as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $nested_key => $nested_val) {
                    $this->args[$key][$nested_key] = $nested_val;
                }
                continue;
            }
            $this->args[$key] = $val;
        }
    }
}