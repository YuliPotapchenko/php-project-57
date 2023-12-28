<?php

return [
    'flash' => [
        'success' => [
            'added' => ':subject has been added',
            'changed' => ':subject has been changed',
            'deleted' => ':subject has been deleted',
            'addedStatus' => 'Status changed successfully',
            'updatedStatus' => 'Status changed successfully',
            'deletedStatus' => 'Status deleted successfully',
        ],
        'error' => [
            'deletedStatus' => 'Failed to delete status',
            'deletedLabel' => 'Failed to remove label',
        ],
        'validation' => [
            'taskUnique' => 'A task with the same name already exists',
            'statusUnique' => 'A status with the same name already exists',
            'labelUnique' => 'A label with the same name already exists',
        ],
    ],
    'alert' => [
        'confirm' => 'Are you sure?'
    ]
];
