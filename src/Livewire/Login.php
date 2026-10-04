<?php

declare(strict_types=1);

namespace Softmony\Dashboard\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Softmony\Dashboard\Contracts\HandlesLoginFailure;

#[Layout('dashboard::layouts.guest')]
class Login extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required')]
    public string $password = '';

    public bool $remember = false;

    public function login(HandlesLoginFailure $failures): void
    {
        $this->validate();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $failures->failed($this->email);
            $this->addError('email', 'Invalid credentials.');

            return;
        }

        session()->regenerate();

        $home = config('dashboard.home_route')
            ?: config('dashboard.brand_route')
            ?: 'dashboard';

        $this->redirect(route($home), navigate: true);
    }

    public function render(): View
    {
        return view('dashboard::livewire.login');
    }
}
