<div>
    <x-shared.heading-subheading
        heading="Contracts"
        subheading="List of all {{ getCompany()->name }} contracts"
    />

    

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-gray-400 border-b">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Employee Detail
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Contract Detail
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rate
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $contract)
                <tr class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <span class="text-sm text-gray-500">
                            {{ $contract->employee->name }}
                        </span>
                        <br>
                        <span class="text-sm text-gray-500">
                            {{ $contract->employee->email }}
                        </span>
                        <br>
                        <span class="text-sm text-gray-500">
                            {{ $contract->employee->phone }}
                        </span>
                        <br>
                        <span class="text-sm text-gray-500">
                            {{ $contract->employee->designation->name }}
                        </span>
                    </th>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-500">
                            Start: {{ $contract->start_date }} 
                        </span>
                        <br>

                        <span class="text-sm text-gray-500">
                            End: {{ $contract->end_date }} 
                        </span>
                        <br>
                        <span class="text-sm text-gray-500">
                            Duration: {{ $contract->duration }} 
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-500">
                            ${{ number_format($contract->rate) }} - {{ $contract->rate_type }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="space-x-2">
                            <flux:button variant="filled" icon="pencil" :href="route('contracts.edit', $contract->id)"/>
                            <!-- 
                                cara kerja loading
                                Ketika tombol delete diklik, Livewire memicu aksi delete.
                                Tombol akan punya data-flux-loading dan wire:target="delete(42)" misalnya.
                                Komponen Flux menangkap ini, dan menampilkan elemen loading-nya:    
                            -->
                            
                            <flux:button variant="danger" icon="trash" wire:click="delete({{ $contract->id }})"/>

                        </div>
                    </td>
                </tr>
               
                @endforeach
            
            </tbody>
        </table>
        <div class="px-6 py-4 dark:bg-zinc-900 bg-zinc-50">
            {{ $contracts->links() }}
        </div>
    </div>
</div>
