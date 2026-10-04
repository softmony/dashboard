<?php

declare(strict_types=1);

namespace Softmony\Dashboard\Auth;

use Softmony\Dashboard\Contracts\HandlesLoginFailure;

class NullLoginFailureHandler implements HandlesLoginFailure
{
    public function failed(string $email): void
    {
        //
    }
}
