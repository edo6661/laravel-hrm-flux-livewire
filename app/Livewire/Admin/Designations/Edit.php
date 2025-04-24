<?php

namespace App\Livewire\Admin\Designations;

use App\Models\Department;
use App\Models\Designation;
use Livewire\Component;

class Edit extends Component
{
    public  $designation;
    public function mount($id)
    {
        $this->designation = Designation::find($id);
        if (!$this->designation) {
            session()->flash('error', 'Designation not found.');
            return $this->redirect(route("designations.index"));
        }
    }
    public function rules()
    {
        return [
            'designation.name' => 'required|string|max:255',
            'designation.department_id' => 'required|exists:departments,id'
        ];
    }
    public function edit()
    {
        $this->validate();
        $this->designation->save();
        session()->flash('success', 'Designation edited successfully.');
        // ! Coba redirect ke halaman yang sebelumnya ingin diakses user (misalnya sebelum login). Kalau tidak ada halaman yang dimaksud, fallback ke route yang kamu kasih.


        return $this->redirectIntended(route("designations.index"), true);
    }

    public function render()
    {
        return view('livewire.admin.designations.edit', [
            'departments' => Department::inCompany()->get(),

        ]);
    }
}
