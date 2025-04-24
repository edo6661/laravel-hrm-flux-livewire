<div>
    <x-shared.heading-subheading
    heading="Contract"
    subheading="Create a new contract"
    />
    <x-shared.form-container action="save">
       <div>
        <flux:input label="Employee" wire:model.live="search" :invalid="$errors->has('search')" type="text" placeholder="Search for an Employee"/>
            @if($search != '' && $employees->count() > 0)
                <ul class="w-full">
                    @foreach($employees as $employee)
                        <li class="p-2 bg-zinc-50 dark:bg-zinc-900 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer" wire:click="selectEmployee({{ $employee->id }})" wire:click="selectEmployee({{ $employee->name }})">
                            <span class="text-sm text-gray-500">
                                {{ $employee->name }}
                            </span>
                        </li>   
                    @endforeach
                </ul>
            @endif
       </div>
        <flux:select label="Department" wire:model.live="department_id" :invalid="$errors->has('department_id')">
            <option selected>Select a department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </flux:select>
        <flux:select label="Designation" wire:model.live="contract.designation_id" :invalid="$errors->has('contract.designation_id')">
            <option selected>Select a designation</option>
            @foreach($designations as $designation)
                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
            @endforeach
        </flux:select>
        <flux:input label="Start Date" wire:model.live="contract.start_date" :invalid="$errors->has('contract.start_date')" type="date"/>
        <flux:input label="End Date" wire:model.live="contract.end_date" :invalid="$errors->has('contract.end_date')" type="date"/>
        <flux:input label="Rate" wire:model.live="contract.rate" :invalid="$errors->has('contract.rate')" type="number"/>
        <flux:select label="Rate Type" wire:model.live="contract.rate_type" :invalid="$errors->has('contract.rate_type')">
            <option selected>Select a rate type</option>
            <option value="daily">Daily</option>
            <option value="monthly">Monthly</option>
        </flux:select>
        
        <flux:button variant="primary" type="submit">
            Save
        </flux:button>
    </x-shared.form-container>
</div>
