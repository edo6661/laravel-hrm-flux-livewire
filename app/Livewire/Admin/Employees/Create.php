<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Livewire\Component;

class Create extends Component
{
    public Employee $employee;
    public $department_id;

    public function rules()
    {
        return [
            'employee.name' => 'required|string|max:255',
            'employee.email' => 'required|email|max:255',
            'employee.phone' => 'required|string|max:255',
            'employee.address' => 'required|string|max:255',
            'employee.designation_id' => 'required|exists:designations,id',

        ];
    }
    public function mount()
    {
        $this->employee = new Employee();
    }
    public function save()
    {
        $this->validate();
        $this->employee->save();
        session()->flash('success', 'Employee created successfully.');
        return $this->redirectIntended(route("employees.index"), true);
    }


    public function render()
    {
        return view('livewire.admin.employees.create', [
            'designations' => Designation::inCompany()->where('department_id', $this->department_id)->get(),
            'departments' => Department::inCompany()->get(),
        ]);
    }
}
