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
        'name' => 'Tải lên file',
        'icon' => 'ti-bar-chart-alt',
        'has_sub_menu' => false,
        'roles' => ['upload'],
        'route' => 'upload.index',
    ],
    [
        'name' => 'Xem nội dung tải lên',
        'icon' => 'ti-bar-chart-alt',
        'has_sub_menu' => false,
        'roles' => ['preview'],
        'route' => 'upload.preview',
    ],
    [
        'name' => 'Lịch sử',
        'icon' => 'ti-bar-chart-alt',
        'has_sub_menu' => false,
        'roles' => ['history'],
        'route' => 'history.index',
    ],
];
