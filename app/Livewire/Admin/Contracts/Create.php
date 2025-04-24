<?php

namespace App\Livewire\Admin\Contracts;

use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public $contract;
    public $search = '';
    public $department_id;

    public function rules()
    {
        return [
            'contract.designation_id' => 'required|exists:designations,id',
            'contract.employee_id' => 'required|exists:employees,id',
            'contract.start_date' => 'required|date',
            'contract.end_date' => 'required|date|after:contract.start_date',
            'contract.rate_type' => 'required|in:daily,monthly',
            'contract.rate' => 'required|numeric|min:0',
        ];
    }
    public function mount()
    {
        $this->contract = new Contract();
    }

    public function selectEmployee($id)
    {
        $this->contract->employee_id = $id;
        $this->search = $this->contract->employee->name;
    }

    public function save()
    {
        $this->validate();
        if ($this->contract->employee->getActiveContract($this->contract->start_date, $this->contract->end_date)) {
            throw ValidationException::withMessages([
                'contract.start_date' => 'This employee already has an active contract during this period.',
            ]);
        }
        $this->contract->save();

        session()->flash('message', 'Contract created successfully.');

        return $this->redirectIntended(route('contracts.index'));
    }
    public function render()
    {
        $employees = Employee::inCompany()->searchByName($this->search)->get();
        $departments = Department::inCompany()->get();
        $designations = $this->department_id ? Department::find($this->department_id)->designations : collect();
        return view('livewire.admin.contracts.create', [
            'employees' => $employees,
            'departments' => $departments,
            'designations' => $designations,
        ]);
    }
}
