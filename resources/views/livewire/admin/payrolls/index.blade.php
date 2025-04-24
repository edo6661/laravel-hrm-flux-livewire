<div>
    <x-shared.heading-subheading
        heading="Payrolls"
        subheading="List of all {{ getCompany()->name }} payrolls"
    />
    <div class="flex items-center justify-between mb-4">
        <div class="flex-1">
            <flux:input type="month" name="month" wire:model="monthYear" placeholder="Choose month" />
        </div>
        <div>
            <flux:button variant="primary" wire:click="generatePayroll">
                Generate Payroll
            </flux:button>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-gray-400 border-b">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Month
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Company
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sum of Payroll
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payrolls as $payroll)
                <tr class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900" wire:click="viewPayroll({{ $payroll->id }})">

                    <td class="px-6 py-4">
                        {{ $payroll->month_string }}
                    </td>
                    <td class="px-6 py-4">
                        {{ getCompany()->name }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ number_format($payroll->salaries?->sum('gross_salary'))  }}
                    </td>
                    
                </tr>
                @endforeach
            
            </tbody>
        </table>
        @if($errors->has('monthYear'))
            <div class="text-red-500 text-sm mt-2">
                {{ $errors->first('monthYear') }}
            </div>
        @endif
        @if($payrolls->count() > 5)
            <div class="px-6 py-4 dark:bg-zinc-900 bg-zinc-50">
                {{ $payrolls->links() }}
            </div>
        @endif
    </div>
</div>
