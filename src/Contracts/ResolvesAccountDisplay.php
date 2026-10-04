<?php

declare(strict_types=1);

namespace Softmony\Dashboard\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;

interface ResolvesAccountDisplay
{
    public function displayName(Authenticatable $user): string;

    public function email(Authenticatable $user): ?string;

    public function initials(Authenticatable $user): string;
}
