<div>
    <x-shared.heading-subheading
        heading="Designations"
        subheading="List of all {{ getCompany()->name }} designations"
    />

    

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-gray-400 border-b">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Department
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Number of Employees
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($designations as $designation)
                <tr class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $designation->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $designation->department->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $designation->employees->count() }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="space-x-2">
                            <flux:button variant="filled" icon="pencil" :href="route('designations.edit', $designation->id)"/>
                            <!-- 
                                cara kerja loading
                                Ketika tombol delete diklik, Livewire memicu aksi delete.
                                Tombol akan punya data-flux-loading dan wire:target="delete(42)" misalnya.
                                Komponen Flux menangkap ini, dan menampilkan elemen loading-nya:    
                            -->
                            
                            <flux:button variant="danger" icon="trash" wire:click="delete({{ $designation->id }})"/>

                        </div>
                    </td>
                </tr>
               
                @endforeach
            
            </tbody>
        </table>
        <div class="px-6 py-4 dark:bg-zinc-900 bg-zinc-50">
            {{ $designations->links() }}
        </div>
    </div>
</div>
