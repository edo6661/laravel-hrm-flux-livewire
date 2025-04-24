<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Livewire\Component;

class Edit extends Component
{
    public $employee;
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
    public function mount($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            session()->flash('error', 'Employee not found.');
            return redirect()->route('employees.index');
        }
        $this->employee = $employee;
        $this->department_id = $this->employee->designation->department_id;
    }
    public function edit()
    {
        $this->validate();
        $this->employee->save();
        session()->flash('success', 'Employee edited successfully.');
        return $this->redirectIntended(route("employees.index"), true);
    }


    public function render()
    {
        return view('livewire.admin.employees.edit', [
            'designations' => Designation::inCompany()->where('department_id', $this->department_id)->get(),
            'departments' => Department::inCompany()->get(),
        ]);
    }
}
