<?php

namespace Cambalacheo\FormField;

use Form;
use Cambalacheo\FormField\Buildable;
use Illuminate\Session\Store as Session;
use Cambalacheo\FormField\FormInputBasic;

class FormField implements Buildable
{
    /**
     * Decorators list
     * @var array
     */
    protected $decorators;

    /**
     * The session store implementation
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * Basic input
     *
     * @var [type]
     */
    protected $input;

    /**
     * Constructor
     *
     * @param Cambalacheo\FormField\FormInputBasic $input
     */
    public function __construct(FormInputBasic $input)
    {
        $this->input = $input;
    }

    /**
     * Build the form field
     *
     * @param  string $name
     * @param  array  $args
     *
     * @return string
     */
    public function build($name, array $args, Session $session)
    {
        $input = $this->applyDecorators($this->input);

        $this->cleanDecorators();

        return $input->build($name, $args, $session);
    }

    /**
     * Set the decorators
     *
     * @param array $decorators
     *
     * @return Cambalacheo\FormField\FormField
     */
    public function setDecorators(array $decorators)
    {
        $this->decorators = $decorators;
        return $this;
    }

    /**
     * Get decorators if there're any
     *
     * @return array
     */
    public function getDecorators()
    {
        return $this->decorators ?: [];
    }

    /**
     * Set a list of decorators to work with
     *
     * @param  string|array $decorators
     * @return Cambalacheo\FormField\FormField
     */
    public function with($decorators)
    {
        $decorators = $this->processDecorators(func_get_args());

        return $this->setDecorators($decorators);
    }

    /**
     * Build an input with the name given
     *
     * @param  string $name
     * @param  array $args
     * @return string
     */
    public function __call($name, $args)
    {
        $args = empty($args) ? [] : $args[0];
        return $this->build($name, $args, $this->getSessionStore());
    }

    /**
     * Get the session store implementation.
     *
     * @return  \Illuminate\Session\Store  $session
     */
    public function getSessionStore()
    {
        return $this->session;
    }

    /**
     * Set the session store implementation.
     *
     * @param  \Illuminate\Session\Store  $session
     * @return $this
     */
    public function setSessionStore(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Apply all the decorators to the basic input field
     *
     * @param  Cambalacheo\FormField\Buildable $input
     * @return Cambalacheo\FormField\Buildable
     */
    protected function applyDecorators(Buildable $input)
    {
        foreach ($this->getDecorators() as $decorator => $args) {
            $input = new $decorator($input);
            $input->setArguments($args);
        }

        return $input;
    }

    /**
     * Clean all decorators once the string is built
     *
     * @return Cambalacheo\FormField\FormField
     */
    protected function cleanDecorators()
    {
        $this->decorators = null;
        return $this;
    }

    /**
     * Process decorators to full path classes and extract
     * arguments.
     *
     * @param  array  $decorators
     * @return array
     */
    protected function processDecorators(array $rawDecorators)
    {
        $namespace = __NAMESPACE__ . '\\Decorator\\';

        $decorators = [];
        foreach ($rawDecorators as $key => $decorator) {
            // integer $key, string $decorator
            if (is_string($decorator)) {
                $key  = $decorator;
                $args = [];
            }

            // string $key, array $decorator
            if (is_array($decorator) && is_string($key)) {
                $args = $decorator;
            }

            // integer $key, array $decorator
            if (is_array($decorator) && ! is_string($key)) {
                $key  = key($decorator);
                $args = current($decorator);
            }

            $key = $namespace . ucfirst($key);
            $decorators[$key] =  $args;
        }

        return $decorators;
    }
}
