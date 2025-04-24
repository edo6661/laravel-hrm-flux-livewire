<div>
    <x-shared.heading-subheading
    heading="Employee"
    subheading="Edit Employee"
    />
    <x-shared.form-container action="edit">
        <flux:input label="Name" wire:model.live="employee.name" :invalid="$errors->has('employee.name')" type="text"/>
        <flux:input label="Email" wire:model.live="employee.email" :invalid="$errors->has('employee.email')" type="text"/>
        <flux:input label="Address" wire:model.live="employee.address" :invalid="$errors->has('employee.address')" type="text"/>
        <flux:input label="Phone" wire:model.live="employee.phone" :invalid="$errors->has('employee.phone')" type="text"/>
        
        <flux:select label="Department" wire:model.live="department_id" :invalid="$errors->has('department_id')">
            <option selected>Select a department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </flux:select>
        <flux:select label="Designation" wire:model.live="employee.designation_id" :invalid="$errors->has('employee.designation_id')">
            <option selected>Select a designation</option>
            @foreach($designations as $designation)
                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
            @endforeach
        </flux:select>
        <flux:button variant="primary" type="submit">
            Save
        </flux:button>
    </x-shared.form-container>
</div>
