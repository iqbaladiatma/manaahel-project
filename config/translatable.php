<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | An array of the locales that the application supports.
    |
    */
    'locales' => [
        'id',
        'en',
        'ar',
    ],

    /*
    |--------------------------------------------------------------------------
    | Locale Separator
    |--------------------------------------------------------------------------
    |
    | This is the separator used to glue the language and the country when
    | defining the available locales. Example: if set to '-', then the
    | locale for Spanish (Spain) would be 'es-ES'.
    |
    */
    'locale_separator' => '_',

    /*
    |--------------------------------------------------------------------------
    | Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale is the locale that will be used when the current
    | locale is not available. You may change the value to any of the
    | locales which will be supported by the application.
    |
    */
    'fallback_locale' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Translation Suffix
    |--------------------------------------------------------------------------
    |
    | Defines the default 'Translation' suffix for the translation model.
    |
    */
    'translation_suffix' => 'Translation',

    /*
    |--------------------------------------------------------------------------
    | Locale Key
    |--------------------------------------------------------------------------
    |
    | Defines the 'locale' field name, which is used by the translation model.
    |
    */
    'locale_key' => 'locale',

    /*
    |--------------------------------------------------------------------------
    | Always Load Translations
    |--------------------------------------------------------------------------
    |
    | Setting this to true will cause the translations to always be loaded
    | from the database. Setting this to false will cause the translations
    | to be loaded only when they are accessed.
    |
    */
    'always_load_translations' => false,

    /*
    |--------------------------------------------------------------------------
    | Use Property Fallback
    |--------------------------------------------------------------------------
    |
    | Should the package use property fallback when a translation is missing?
    |
    */
    'use_property_fallback' => true,

    /*
    |--------------------------------------------------------------------------
    | Fallback Any Locale
    |--------------------------------------------------------------------------
    |
    | If true, the package will fallback to any available locale if the
    | requested locale is not available.
    |
    */
    'fallback_any_locale' => true,
];
