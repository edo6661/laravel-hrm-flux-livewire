<?php

namespace App\Livewire\Admin\Designations;

use App\Models\Department;
use App\Models\Designation;
use Livewire\Component;

class Create extends Component
{
    public  $designation;
    public function mount()
    {
        $this->designation = new Designation();
    }
    public function rules()
    {
        return [
            'designation.name' => 'required|string|max:255',
            /* 
            ! Laravel akan memastikan bahwa:
            * department_id tidak boleh kosong (required)
            * Nilai dari department_id tersebut harus sesuai dengan ID dari salah satu record di tabel departments. Kalau tidak ada ID yang cocok, maka akan gagal validasi.
            */
            'designation.department_id' => 'required|exists:departments,id',
        ];
    }
    public function save()
    {
        $this->validate();
        $this->designation->save();
        session()->flash('success', 'Designation created successfully.');
        return $this->redirectIntended(route("designations.index"), true);
    }
    public function render()
    {
        return view('livewire.admin.designations.create', [
            'departments' => Department::inCompany()->get(),
        ]);
    }
}
