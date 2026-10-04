<?php

declare(strict_types=1);

namespace Softmony\Dashboard\View\Components\Admin\Account;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Softmony\Dashboard\Contracts\ResolvesAccountDisplay;

class Menu extends Component
{
    public string $displayName;

    public ?string $email;

    public string $initials;

    /** @var list<array<string, mixed>> */
    public array $menu;

    public string $logoutRoute;

    public function __construct(ResolvesAccountDisplay $account)
    {
        $user = Auth::user();

        $this->displayName = $user instanceof Authenticatable ? $account->displayName($user) : '';
        $this->email = $user instanceof Authenticatable ? $account->email($user) : null;
        $this->initials = $user instanceof Authenticatable ? $account->initials($user) : '?';
        $this->menu = config('dashboard.account.menu', []);
        $this->logoutRoute = (string) config('dashboard.logout_route', 'logout');
    }

    public function shouldRender(): bool
    {
        return Auth::check();
    }

    public function render(): View
    {
        return view('dashboard::admin.account.menu');
    }
}
