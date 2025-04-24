<div>
    <x-shared.heading-subheading
    heading="Department"
    subheading="Create a new department"
    />
    <x-shared.form-container action="save">
        <flux:input label="Name" wire:model.live="department.name" :invalid="$errors->has('department.name')" type="text"/>
        <flux:button variant="primary" type="submit">
            Save
        </flux:button>
    </x-shared.form-container>
</div>
