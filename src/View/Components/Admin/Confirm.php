<?php

declare(strict_types=1);

namespace Softmony\Dashboard\View\Components\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Confirm extends Component
{
    public function __construct(
        public string $confirmLabel = 'Confirm',
        public string $cancelLabel = 'Cancel',
        public bool $danger = true,
    ) {}

    public function render(): View
    {
        return view('dashboard::admin.confirm');
    }
}
