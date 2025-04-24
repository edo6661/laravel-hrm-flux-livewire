<div>
    <x-shared.heading-subheading
        heading="Company"
        subheading="Edit company: {{ $company->name }}"
    />

    <x-shared.form-container action="edit" enctype="multipart/form-data">
        <flux:input label="Name" wire:model.live="company.name" :invalid="$errors->has('company.name')" type="text"/>
        <flux:input label="Email" wire:model.live="company.email" :invalid="$errors->has('company.email')" type="email"/>
        <flux:input label="Website" wire:model.live="company.website" :invalid="$errors->has('company.website')" type="url"/>

        <div class="mt-4 border-t pt-4">
            <label for="logo_upload" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Logo</label>

            <div class="mb-2">
                @if ($logo)
                    <img src="{{ $logo->temporaryUrl() }}" alt="New Logo Preview" class="h-20 w-auto border rounded shadow-sm">
                @elseif ($company->logo)
                    <img src="{{ Storage::url($company->logo) }}" alt="Current Logo" class="h-20 w-auto border rounded shadow-sm">
                @endif
            </div>

            <flux:input
                label=""
                id="logo_upload"
                wire:model.live="logo"
                :invalid="$errors->has('logo')"
                type="file"
            />
            @error('logo')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div class="pt-4 border-t mt-4">
            <flux:button variant="primary" type="submit" wire:loading.attr="disabled" wire:target="logo">
                <span wire:loading.remove wire:target="logo">
                    Save Changes
                </span>
            </flux:button>
        </div>
    </x-shared.form-container>
</div>
