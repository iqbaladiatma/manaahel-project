<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | This array contains all the locales that the application supports.
    | The keys are the locale codes and the values are the display names.
    |
    */
    'supported_locales' => [
        'id' => 'Bahasa Indonesia',
        'en' => 'English',
        'ar' => 'العربية',
    ],

    /*
    |--------------------------------------------------------------------------
    | RTL Locales
    |--------------------------------------------------------------------------
    |
    | This array contains all the locales that use Right-to-Left (RTL) layout.
    |
    */
    'rtl_locales' => [
        'ar',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | The default locale that will be used when no locale is specified.
    |
    */
    'default_locale' => env('APP_LOCALE', 'id'),
];
