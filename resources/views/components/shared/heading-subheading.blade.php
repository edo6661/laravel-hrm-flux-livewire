@props([
    'heading' => "Please provide a heading",
    'subheading' => "Please provide a subheading",
])
<div class="relative mb-6 w-full space-y-2">
    <flux:heading size="xl" level="1">
        {{ $heading }}
    </flux:heading>
    
    <flux:heading level="2">
        {{ $subheading }}
    </flux:heading>
    <flux:separator/>
</div>
