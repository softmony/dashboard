<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Livewire\Livewire;
use Softmony\Dashboard\Livewire\Login;
use Softmony\Dashboard\View\Components\Admin\Sidebar;

it('merges the dashboard config', function () {
    expect(config('dashboard.brand_subtitle'))->toBe('Admin')
        ->and(config('dashboard.logout_route'))->toBe('logout');
});

it('registers the login screen', function () {
    expect(Livewire::new('dashboard.login'))->toBeInstanceOf(Login::class);
});

it('marks the matching sidebar item active', function () {
    Route::get('/dashboard', fn () => 'dashboard')->name('dashboard');
    Route::get('/pages', function () {
        $sidebar = new Sidebar;
        $pages = collect($sidebar->nav)->firstWhere('label', 'Pages');
        $dashboard = collect($sidebar->nav)->firstWhere('label', 'Dashboard');

        return ($pages['is_active'] && ! $dashboard['is_active']) ? 'active' : 'inactive';
    })->name('pages.index');

    config([
        'dashboard.brand_route' => 'dashboard',
        'dashboard.nav' => [
            ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => 'dashboard'],
            ['label' => 'Pages', 'route' => 'pages.index', 'active' => 'pages.*'],
        ],
    ]);

    expect($this->get('/pages')->getContent())->toBe('active');
});

it('renders the admin building blocks', function () {
    $errors = new ViewErrorBag;
    $errors->put('default', new MessageBag([
        'title' => ['The title is required.'],
    ]));
    app('view')->share('errors', $errors);
    session()->flash('status', 'Saved.');

    $html = Blade::render(<<<'BLADE'
        <x-admin.heading title="Pages" description="Site tree">
            <x-admin.button size="sm">New page</x-admin.button>
        </x-admin.heading>
        <x-admin.switch label="Active" :on="true" />
        <x-admin.field label="Title" error="title">
            <x-admin.input wire:model="title" />
        </x-admin.field>
        <x-admin.slug wire:model="slug" />
        <x-admin.segmented property="type" :value="'page'" :options="['page' => 'Page', 'legal' => 'Legal']" />
        <x-admin.confirm>
            <p>Inside confirm</p>
        </x-admin.confirm>
        <x-admin.flash />
        <x-alert type="danger" title="Could not save">Try again.</x-alert>
        <x-admin.table>
            <x-slot:head>
                <x-admin.th>Title</x-admin.th>
            </x-slot:head>
            <x-admin.empty :colspan="1">No rows</x-admin.empty>
        </x-admin.table>
        <x-admin.move up="move(1, 'up')" down="move(1, 'down')" :up-disabled="true" />
        <x-admin.image input-id="img-1" src="/photo.jpg" preview="/tmp.jpg" />
        <x-admin.stat label="Pages" value="12" href="/pages" />
        <x-admin.split>
            <p>Main column</p>
            <x-slot:aside><p>Aside column</p></x-slot:aside>
        </x-admin.split>
        <x-admin.editor property="body" value="<p>Hello</p>" />
        <x-admin.breadcrumb :items="[['label' => 'Pages', 'url' => '/pages'], ['label' => 'Edit']]" />
        <x-admin.card>
            <p>Card body</p>
        </x-admin.card>
        <x-admin.actions>
            <span>Save</span>
            <x-slot:end><span>Delete</span></x-slot:end>
        </x-admin.actions>
        <x-admin.textarea>Notes</x-admin.textarea>
        <x-admin.row-button>Open row</x-admin.row-button>
        <x-admin.logo />
    BLADE);

    expect($html)
        ->toContain('Pages')
        ->toContain('Site tree')
        ->toContain('role="switch"')
        ->toContain('aria-checked="true"')
        ->toContain('The title is required.')
        ->toContain('Regenerate slug')
        ->toContain('Legal')
        ->toContain('Inside confirm')
        ->toContain('$wire.call(method, ...params)')
        ->toContain('Saved.')
        ->toContain('Could not save')
        ->toContain('No rows')
        ->toContain('Move up')
        ->toContain('disabled')
        ->toContain('src="/tmp.jpg"')
        ->toContain('href="/pages"')
        ->toContain('Main column')
        ->toContain('Aside column')
        ->toContain('quill@2.0.3')
        ->toContain('aria-current="page"')
        ->toContain('Card body')
        ->toContain('Delete')
        ->toContain('Notes')
        ->toContain('Open row');
});
