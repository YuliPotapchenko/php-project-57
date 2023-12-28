<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'confirmed' => 'Пароль и подтверждение не совпадают',
    'min' => [
        'string' => 'Пароль должен иметь длину не менее 8 символов.',
    ],
    'max' => [
        'string' => 'Длина имени не должна превышать :max символов.',
    ],
    'required' => 'Это обязательное поле',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'task-name' => [
            'rule-name' => 'custom-message',
        ],
        'name' => [
            'required' => 'Это обязательное поле',
            'unique' => 'Статус с таким именем уже существует',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
