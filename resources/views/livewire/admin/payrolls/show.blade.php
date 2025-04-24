<div>
    <x-shared.heading-subheading
        heading="Payroll"
        subheading="Payroll Breakdown for {{ getCompany()->name }} during {{ $payroll->month_string }}"
    />
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-gray-400 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Employee Details</th>
                    <th scope="col" class="px-6 py-3">Gross Salary</th>
                 
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payroll->salaries as $salary)
                    <tr class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <span>{{ $salary->employee->name }}</span><br>
                            <span>{{ $salary->employee->designation->name }}</span>
                        </th>
                        <td class="px-6 py-4">
                            $ {{ number_format($salary->gross_salary, 2) }}
                        
                        <td class="px-6 py-4">
                            <div class="space-x-2">
                                <flux:tooltip content="Download Payslip">
                                    <flux:button variant="filled" icon="document" wire:click="generatePayslip({{ $salary->id }})" />

                                </flux:tooltip>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
