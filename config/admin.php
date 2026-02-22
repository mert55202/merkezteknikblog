<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin rolleri ve yetkileri
    |--------------------------------------------------------------------------
    | Her rolün hangi yetkilere sahip olduğu burada tanımlanır.
    | Menü ve route erişimi bu yetkilere göre otomatik kısıtlanır.
    */

    'roles' => [
        'super_admin' => [
            'label' => 'Süper Admin',
            'permissions' => ['dashboard', 'categories', 'brands', 'services', 'site_contents', 'users', 'reports'],
        ],
        'admin' => [
            'label' => 'Admin',
            'permissions' => ['dashboard', 'categories', 'brands', 'services', 'site_contents', 'reports'],
        ],
        'editor' => [
            'label' => 'Editör',
            'permissions' => ['dashboard', 'categories', 'brands', 'services', 'reports'],
        ],
        'viewer' => [
            'label' => 'Görüntüleyici',
            'permissions' => ['dashboard'],
        ],
    ],

    'default_role' => 'admin',

];
