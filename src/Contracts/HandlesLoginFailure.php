<?php

declare(strict_types=1);

namespace Softmony\Dashboard\Contracts;

interface HandlesLoginFailure
{
    public function failed(string $email): void;
}
