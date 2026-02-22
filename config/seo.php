<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site bilgileri (SEO, JSON-LD, sosyal paylaşım)
    |--------------------------------------------------------------------------
    */

    'site_name' => env('SEO_SITE_NAME', 'Merkez Teknik Blog'),
    'default_description' => env('SEO_DEFAULT_DESCRIPTION', 'Merkez Teknik Blog - Teknik blog ve rehberler.'),
    'twitter_handle' => env('SEO_TWITTER_HANDLE', ''), // @kullaniciadi (boş bırakılabilir)
    'facebook_app_id' => env('SEO_FACEBOOK_APP_ID', ''),
    'default_image' => null, // null ise header logo kullanılır
    'theme_color' => env('SEO_THEME_COLOR', '#1e3a5f'), // Mobil tarayıcı adres çubuğu rengi

];
