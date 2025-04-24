<div>
    <x-shared.heading-subheading
        heading="Employees"
        subheading="List of all employees"
    />

    

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-gray-400 border-b">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company
                    </th>
                  
                    <th scope="col" class="px-6 py-3">
                        Designation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $employee->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $employee->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employee->phone }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employee->address }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employee->designation->department->company->name }}
                    </td>
                   
                    <td class="px-6 py-4">
                        {{ $employee->designation->name }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="space-x-2">
                            <flux:button variant="filled" icon="pencil" :href="route('employees.edit', $employee->id)"/>
                            <!-- 
                                cara kerja loading
                                Ketika tombol delete diklik, Livewire memicu aksi delete.
                                Tombol akan punya data-flux-loading dan wire:target="delete(42)" misalnya.
                                Komponen Flux menangkap ini, dan menampilkan elemen loading-nya:    
                            -->
                            
                            <flux:button variant="danger" icon="trash" wire:click="delete({{ $employee->id }})"/>

                        </div>
                    </td>
                </tr>
               
                @endforeach
            
            </tbody>
        </table>
        <div class="px-6 py-4 dark:bg-zinc-900 bg-zinc-50">
            {{ $employees->links() }}
        </div>
    </div>
</div>
