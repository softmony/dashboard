<div class="mx-auto w-full max-w-md rounded border border-slate-200 bg-white p-6">
    <h1 class="mb-4 text-lg font-semibold text-slate-900">Sign in</h1>

    <form wire:submit="login" class="space-y-4">
        <x-admin.field label="Email" error="email">
            <x-admin.input type="email" wire:model="email" />
        </x-admin.field>
        <x-admin.field label="Password" error="password">
            <x-admin.input type="password" wire:model="password" />
        </x-admin.field>
        <label class="flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" wire:model="remember" class="rounded border-slate-300" />
            Remember me
        </label>
        <x-admin.button type="submit" class="w-full">Sign in</x-admin.button>
    </form>
</div>
