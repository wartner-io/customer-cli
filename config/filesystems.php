<?php

return [
    'default' => 'local',
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => $_SERVER['HOME'] . '/Google Drive/Meine Ablage/Customers',
        ],
    ],
];
