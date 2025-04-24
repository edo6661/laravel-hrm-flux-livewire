<div>
    <x-shared.heading-subheading
    heading="Designation"
    subheading="Create a new designation"
    />
    <x-shared.form-container action="save">
        <flux:input label="Name" wire:model.live="designation.name" :invalid="$errors->has('designation.name')" type="text"/>
        <flux:select label="Department" wire:model.live="designation.department_id" :invalid="$errors->has('designation.department_id')">
            <option selected>Select a department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </flux:select>
        <flux:button variant="primary" type="submit">
            Save
        </flux:button>
    </x-shared.form-container>
</div>
