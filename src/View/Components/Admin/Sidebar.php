<?php

declare(strict_types=1);

namespace Softmony\Dashboard\View\Components\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public string $brandHref;

    public ?string $subtitle;

    public ?string $logo;

    /** @var list<array{label: string, href: string, is_active: bool}> */
    public array $nav;

    public function __construct()
    {
        $brandRoute = config('dashboard.brand_route');
        $subtitle = config('dashboard.brand_subtitle');
        $logo = config('dashboard.brand_logo');

        $this->brandHref = is_string($brandRoute) && $brandRoute !== '' ? route($brandRoute) : '#';
        $this->subtitle = is_string($subtitle) && $subtitle !== '' ? $subtitle : null;
        $this->logo = is_string($logo) && $logo !== '' ? $logo : null;
        $this->nav = $this->navItems();
    }

    public function render(): View
    {
        return view('dashboard::admin.sidebar');
    }

    /**
     * @return list<array{label: string, href: string, is_active: bool}>
     */
    private function navItems(): array
    {
        return collect(config('dashboard.nav', []))
            ->map(function (array $item): array {
                $routeName = $item['route'] ?? null;
                $active = $item['active'] ?? $routeName;
                $activePatterns = array_values(array_filter(
                    is_array($active) ? $active : [$active],
                    fn (mixed $pattern): bool => is_string($pattern) && $pattern !== '',
                ));

                return [
                    'label' => (string) ($item['label'] ?? ''),
                    'href' => is_string($routeName) && $routeName !== ''
                        ? route($routeName)
                        : (string) ($item['url'] ?? '#'),
                    'is_active' => $activePatterns !== [] && request()->routeIs(...$activePatterns),
                ];
            })
            ->all();
    }
}
