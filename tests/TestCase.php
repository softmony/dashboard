<?php

declare(strict_types=1);

namespace Softmony\Dashboard\Tests;

use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Softmony\Dashboard\DashboardServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            DashboardServiceProvider::class,
        ];
    }
}
