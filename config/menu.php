<?php

return [
    [
        'name' => 'Dashboard',
        'icon' => 'ti-bar-chart-alt',
        'has_sub_menu' => false,
        'roles' => ['dashboard'],
        'route' => 'dashboard',
    ],
    [
        'name' => 'Upload File',
        'icon' => 'ti-bar-chart-alt',
        'has_sub_menu' => false,
        'roles' => ['upload'],
        'route' => 'upload.index',
    ],
    [
        'name' => 'History',
        'icon' => 'ti-bar-chart-alt',
        'has_sub_menu' => false,
        'roles' => ['history'],
        'route' => 'history.index',
    ],
];
