<?php
// lang/uk/validation.php
return [
    'required'  => 'Поле :attribute є обов’язковим.',
    'email'     => 'Поле :attribute має містити коректну адресу електронної пошти.',
    'confirmed' => 'Підтвердження поля :attribute не збігається.',
    'unique'    => 'Таке значення поля :attribute вже використовується.',
    'min'       => ['string' => 'Поле :attribute має містити щонайменше :min символів.'],
    'max'       => ['string' => 'Поле :attribute не має перевищувати :max символів.'],
    'attributes' => [
        'name'             => 'ім’я',
        'email'            => 'електронна пошта',
        'password'         => 'пароль',
        'current_password' => 'поточний пароль',
    ],
];
