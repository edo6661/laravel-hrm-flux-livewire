
<form {{ $attributes->merge(['class' => 'space-y-4']) }} wire:submit="{{ $action ?? '' }}">
    {{ $slot }}
</form>