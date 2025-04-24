<?php

namespace App\Livewire\Admin\Companies;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public Company $company;
    public $logo;

    public function mount(string $id)
    {
        $this->company = Company::find($id);
        if (!$this->company) {
            session()->flash('error', 'Company not found.');
            return redirect()->route("companies.index");
        }
    }

    public function rules()
    {
        return [
            'company.name' => 'required|string|max:255',
            'company.email' => 'required|email|max:255',
            'company.website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function edit()
    {
        $this->validate();

        $oldLogoPath = $this->company->logo;

        if ($this->logo) {
            $newLogoPath = $this->logo->store('logos', 'public');

            if ($newLogoPath) {
                $this->company->logo = $newLogoPath;

                if ($oldLogoPath) {
                    Storage::disk('public')->delete($oldLogoPath);
                }
            } else {
                session()->flash('error', 'Gagal menyimpan logo baru.');
                return;
            }
        }

        $this->company->save();

        session()->flash('success', 'Company updated successfully.');

        return redirect()->route("companies.index");
    }

    public function render()
    {
        return view('livewire.admin.companies.edit');
    }
}
