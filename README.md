# softmony/dashboard

Reusable Livewire and Blade admin UI for Laravel apps. Tailwind 4, Alpine (via Livewire), Livewire 4.

This package replaces `virgixas/dashboard-ui`. The confirm dialog, switch, and the form and table pieces that lived in Complyfi are part of the package.

MIT — provided as is, without warranty.

## Install

Until Packagist, require it from GitHub:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/softmony/dashboard"
        }
    ],
    "require": {
        "softmony/dashboard": "dev-main"
    }
}
```

```bash
composer update softmony/dashboard
php artisan vendor:publish --tag=dashboard-config
```

Optional view overrides:

```bash
php artisan vendor:publish --tag=dashboard-views
```

The host app owns Vite. Point Tailwind at the package views and hide Alpine `x-cloak` nodes:

```css
@import 'tailwindcss';

@source '../../vendor/softmony/dashboard/resources/views/**/*.blade.php';
@source '../../vendor/livewire/livewire/dist/**/*.js';

[x-cloak] {
    display: none !important;
}
```

Use a package layout on admin screens:

```php
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('dashboard::layouts.admin')]
class PagesIndex extends Component
{
}
```

Login route, when you want the package screen:

```php
use Softmony\Dashboard\Livewire\Login;

Route::middleware(['guest', 'throttle:login'])->group(function () {
    Route::get('/login', Login::class)->name('login');
});
```

## Config

`config/dashboard.php`

| Key | Role |
|---|---|
| `brand_route` | Sidebar brand link |
| `home_route` | Redirect after login. Falls back to `brand_route` |
| `brand_subtitle` | Text under the app name |
| `guest_tagline` | Sign-in screen subtitle |
| `logout_route` | Account menu logout |
| `vite` | Styles and scripts the layouts load |
| `nav` | Sidebar items: `label`, `route` or `url`, `active` |
| `account.menu` | Extra account links (`dispatch`, `route`, or `url`) |
| `account.footer_livewire` | Components mounted at the end of the admin layout |

Replace the account display or login-failure hook by binding `Softmony\Dashboard\Contracts\ResolvesAccountDisplay` or `Softmony\Dashboard\Contracts\HandlesLoginFailure` in the host app.

## Layouts

- `dashboard::layouts.admin` — sidebar, header, account menu
- `dashboard::layouts.guest` — centered sign-in
- `dashboard::layouts.app` — simple top bar for authenticated pages

## Chrome

Class components: `<x-admin.sidebar>`, `<x-admin.account.menu>`, `<x-admin.confirm>`.

Anonymous: `<x-alert>`, `<x-slide-over>`, `<x-admin.logo>`, `<x-admin.breadcrumb>`.

The same tags work as `<x-dashboard::…>`.

`<x-admin.confirm>` wraps the screen. Buttons inside it open the dialog with Alpine — no Livewire confirm state:

```blade
<x-admin.confirm>
    <button
        type="button"
        @click="ask({ method: 'delete', params: [{{ $id }}], title: 'Delete page?', message: 'This soft-deletes the page.' })"
    >Delete</button>
</x-admin.confirm>
```

`ask()` calls `$wire.call(method, ...params)`. `danger` defaults to true (red confirm button).

## Screen components

These are the pieces Complyfi had been styling by hand.

```blade
<div class="space-y-6">
    <x-admin.heading title="Pages" description="Tree structure for site pages.">
        <x-admin.button size="sm" wire:click="openCreatePanel">New root page</x-admin.button>
    </x-admin.heading>

    <x-admin.flash />

    <x-admin.table>
        <x-slot:head>
            <x-admin.th>Title</x-admin.th>
            <x-admin.th></x-admin.th>
        </x-slot:head>

        @forelse ($pages as $page)
            <tr class="hover:bg-slate-50" wire:key="page-{{ $page->id }}">
                <x-admin.td>
                    <x-admin.row-button wire:click="openEditPanel({{ $page->id }})">
                        {{ $page->title }}
                    </x-admin.row-button>
                </x-admin.td>
                <x-admin.td>
                    <div class="flex justify-end">
                        <x-admin.move
                            :up="'move('.$page->id.', \'up\')'"
                            :down="'move('.$page->id.', \'down\')'"
                            :up-disabled="$loop->first"
                            :down-disabled="$loop->last"
                        />
                    </div>
                </x-admin.td>
            </tr>
        @empty
            <x-admin.empty :colspan="2">
                No pages yet.
                <x-admin.button variant="link" wire:click="openCreatePanel">Create one</x-admin.button>
            </x-admin.empty>
        @endforelse
    </x-admin.table>

    <x-slide-over title="New page" open="showCreatePanel" close-method="closeCreatePanel">
        <form wire:submit="create" class="space-y-4">
            <div class="flex justify-end">
                <x-admin.switch label="Active" :on="$isActive" wire:click="$toggle('isActive')" />
            </div>
            <x-admin.field label="Title" error="title">
                <x-admin.input wire:model.live="title" autofocus />
            </x-admin.field>
            <x-admin.field label="Slug" error="slug">
                <x-admin.slug wire:model.live="slug" />
            </x-admin.field>
            <x-admin.field label="Type" error="type">
                <x-admin.segmented
                    label="Type"
                    property="type"
                    :value="$type"
                    :options="$pageTypes"
                />
            </x-admin.field>
            <x-admin.field label="Content" error="body">
                <x-admin.editor property="body" :value="$body" />
            </x-admin.field>
            <x-admin.actions>
                <x-admin.button type="submit">Create</x-admin.button>
                <x-admin.button variant="secondary" wire:click="closeCreatePanel">Cancel</x-admin.button>
            </x-admin.actions>
        </form>
    </x-slide-over>
</div>
```

| Component | Notes |
|---|---|
| `<x-admin.heading>` | Title, optional description, action slot |
| `<x-admin.button>` | `variant`: `primary`, `secondary`, `danger`, `link`. `size`: `md`, `sm` |
| `<x-admin.field>` | Label plus `@error($error)` |
| `<x-admin.input>` | `mono` for monospace |
| `<x-admin.textarea>` | No resize |
| `<x-admin.switch>` | `label`, `on`. Put `wire:click` on the component |
| `<x-admin.slug>` | Input plus regenerate button. `regenerate` defaults to `regenerateSlug` |
| `<x-admin.segmented>` | `options` is value => label. `property` is the Livewire property `$set` writes |
| `<x-admin.table>` | `head` and `footer` slots. Cells are `<x-admin.th>` and `<x-admin.td>` |
| `<x-admin.empty>` | Empty table row. `colspan` |
| `<x-admin.move>` | Up and down buttons. `up` and `down` are Livewire calls |
| `<x-admin.row-button>` | Clickable row title |
| `<x-admin.card>` | Bordered panel. `padded`, optional `header` slot |
| `<x-admin.actions>` | Form footer. Optional `end` slot for a delete button |
| `<x-admin.flash>` | Renders `session('status')`, or pass `status` |
| `<x-admin.image>` | Preview plus file input. `preview` wins over `src`. `input-id`, `target` for `wire:loading`. Extra buttons go in the `actions` slot |
| `<x-admin.editor>` | Quill field. `property` is the Livewire property it writes. `value` is the initial HTML |
| `<x-admin.split>` | Main column plus an `aside` slot |
| `<x-admin.stat>` | Label and value. Optional `href` |
| `<x-alert>` | `type`: `info`, `success`, `warning`, `danger` |
| `<x-slide-over>` | `open` and `close-method` are Livewire property and method names. `max-width`: `sm`–`5xl` |
| `<x-admin.breadcrumb>` | `items`: `label`, optional `url`. The last item is the current page |

## Compatibility

- PHP ^8.3
- Laravel 12 or 13
- Livewire ^4
