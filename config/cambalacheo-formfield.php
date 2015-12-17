<?php

return [

    'commonInputsLookup'  => [
        'email'                 => 'email',
        'name'                  => 'text',
        'description'           => 'textarea',
        'password'              => 'password',
        'password_confirmation' => 'password'
    ],

    // Default decorators config
    'decorator' => [

        'wrapper' => [
            'element' => 'div',
            'class'   => 'form-group',
        ],

        'error' => [
            'class' => 'help-block',
        ],

        'counter' => [
            'max'   => 255,
            'class' => 'small',
            'wrapper' => [
                'class'   => 'input-counter',
                'element' => 'div',
            ],
        ],

    ],

];
