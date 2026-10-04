<?php

declare(strict_types=1);

namespace Softmony\Dashboard\Account;

use Illuminate\Contracts\Auth\Authenticatable;
use Softmony\Dashboard\Contracts\ResolvesAccountDisplay;

class DefaultAccountDisplayResolver implements ResolvesAccountDisplay
{
    public function displayName(Authenticatable $user): string
    {
        return (string) (data_get($user, 'name') ?: 'User');
    }

    public function email(Authenticatable $user): ?string
    {
        $email = data_get($user, 'email');

        return $email !== null && $email !== '' ? (string) $email : null;
    }

    public function initials(Authenticatable $user): string
    {
        $parts = preg_split('/\s+/', trim($this->displayName($user))) ?: [];

        return collect($parts)
            ->filter()
            ->take(2)
            ->map(fn (string $part) => mb_strtoupper(mb_substr($part, 0, 1)))
            ->implode('') ?: '?';
    }
}
