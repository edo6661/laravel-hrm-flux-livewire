<?php

namespace App\Livewire\Admin\Companies;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public Company $company;
    public $logo;
    public function mount()
    {
        $this->company = new Company();
    }
    public function rules()
    {
        return [
            'company.name' => 'required|string|max:255',
            'company.email' => 'required|email|max:255|unique:companies,email',
            'company.website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function save()
    {
        $this->validate();
        if ($this->logo) {
            if ($this->company->logo     && file_exists(storage_path('app/public/' . $this->company->logo))) {
                unlink(storage_path('app/public/' . $this->company->logo));
            }

            $this->company->logo = $this->logo->store('logos', 'public');
        }
        $this->company->save();
        $this->company->users()->attach(Auth::user()->id);
        session()->flash('success', 'Company created successfully.');
        return $this->redirectIntended(route("companies.index"), true);
    }
    public function render()
    {
        return view('livewire.admin.companies.create');
    }
}
