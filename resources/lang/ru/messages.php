<?php

return [
    'flash' => [
        'success' => [
            'added' => ':subject успешно создана',
            'updated' => ':subject успешно изменена',
            'deleted' => ':subject успешно удалена',
            'addedStatus' => 'Статус успешно создан',
            'updatedStatus' => 'Статус успешно изменён',
            'deletedStatus' => 'Статус успешно удалён',
        ],
        'error' => [
            'deletedStatus' => 'Не удалось удалить статус',
            'deletedLabel' => 'Не удалось удалить метку',
        ],
        'validation' => [
            'taskUnique' => 'Задача с таким именем уже существует',
            'statusUnique' => 'Статус с таким именем уже существует',
            'labelUnique' => 'Метка с таким именем уже существует',
        ],
    ],
    'alert' => [
        'confirm' => 'Вы уверены?'
    ],

];
