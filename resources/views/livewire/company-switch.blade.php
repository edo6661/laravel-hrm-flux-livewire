<?php

use Livewire\Volt\Component;
use App\Models\Company;
new class extends Component {
    public Company $company;

    public function mount(Company $company): void
    {
        $this->company = $company;
    }

    public function selectCompany($id) {
        session(['company_id' => $id]);
        return $this->redirectIntended(URL::previous(), true);
    }
}; ?>

<div>
    <flux:menu.item wire:click="selectCompany({{ $company->id }})">
        {{ $company->name }}
    </flux:menu.item>
</div>
