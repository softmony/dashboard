<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    */

    'brand_route' => 'dashboard',

    /** Named route after a successful login. Falls back to brand_route. */
    'home_route' => null,

    /** Text under the brand. Null renders a single row. */
    'brand_subtitle' => 'Admin',

    /** Image URL shown instead of the app name. Null keeps the name. */
    'brand_logo' => null,

    'guest_tagline' => 'Private admin',

    'logout_route' => 'logout',

    /*
    |--------------------------------------------------------------------------
    | Vite entries (the host app owns the Vite build)
    |--------------------------------------------------------------------------
    */

    'vite' => [
        'resources/css/app.css',
        'resources/js/app.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin sidebar navigation
    |--------------------------------------------------------------------------
    |
    | Each item:
    |   label  (string) — link text
    |   route  (string) — named route for href
    |   url    (string) — used when route is omitted
    |   active (string|string[]) — routeIs() pattern(s); defaults to route
    |
    */

    'nav' => [
        // ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => 'dashboard'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Account
    |--------------------------------------------------------------------------
    |
    | account.menu items support:
    |   label + dispatch — Livewire.dispatch(event) button
    |   label + route    — named route link
    |   label + url      — plain href
    |
    | account.footer_livewire — Livewire components mounted at the end of the
    | admin layout (for example a global profile slide-over).
    |
    */

    'account' => [
        'menu' => [
            // ['label' => 'Profile', 'dispatch' => 'open-profile-edit'],
        ],

        'footer_livewire' => [
            // 'profile-edit',
        ],
    ],

];
