<?php

use Illuminate\Foundation\Auth\User;
use Softmony\Dashboard\Account\DefaultAccountDisplayResolver;

it('resolves the display name, email, and initials', function () {
    $user = new class extends User
    {
        protected $attributes = [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ];
    };

    $resolver = new DefaultAccountDisplayResolver;

    expect($resolver->displayName($user))->toBe('Ada Lovelace')
        ->and($resolver->email($user))->toBe('ada@example.com')
        ->and($resolver->initials($user))->toBe('AL');
});

it('falls back when the name or email is missing', function () {
    $user = new class extends User
    {
        protected $attributes = [
            'name' => '',
            'email' => '',
        ];
    };

    $resolver = new DefaultAccountDisplayResolver;

    expect($resolver->displayName($user))->toBe('User')
        ->and($resolver->email($user))->toBeNull()
        ->and($resolver->initials($user))->toBe('U');
});
