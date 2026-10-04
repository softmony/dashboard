<?php

declare(strict_types=1);

namespace Softmony\Dashboard;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Softmony\Dashboard\Account\DefaultAccountDisplayResolver;
use Softmony\Dashboard\Auth\NullLoginFailureHandler;
use Softmony\Dashboard\Contracts\HandlesLoginFailure;
use Softmony\Dashboard\Contracts\ResolvesAccountDisplay;
use Softmony\Dashboard\Livewire\Login;
use Softmony\Dashboard\View\Components\Admin\Account\Menu as AccountMenu;
use Softmony\Dashboard\View\Components\Admin\Confirm;
use Softmony\Dashboard\View\Components\Admin\Sidebar;

class DashboardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/dashboard.php', 'dashboard');

        $this->app->singletonIf(ResolvesAccountDisplay::class, DefaultAccountDisplayResolver::class);
        $this->app->singletonIf(HandlesLoginFailure::class, NullLoginFailureHandler::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashboard');

        $components = __DIR__.'/../resources/views/components';

        Blade::anonymousComponentPath($components);
        Blade::anonymousComponentPath($components, 'dashboard');

        Blade::component('admin.sidebar', Sidebar::class);
        Blade::component('admin.confirm', Confirm::class);
        Blade::component('admin.account.menu', AccountMenu::class);
        Blade::component('dashboard::admin.sidebar', Sidebar::class);
        Blade::component('dashboard::admin.confirm', Confirm::class);
        Blade::component('dashboard::admin.account.menu', AccountMenu::class);

        Livewire::component('dashboard.login', Login::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/dashboard.php' => config_path('dashboard.php'),
            ], 'dashboard-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard'),
            ], 'dashboard-views');
        }
    }
}
