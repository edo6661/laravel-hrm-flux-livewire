<div>
    <x-shared.heading-subheading
    heading="Company"
    subheading="Create a new company"
    />
    <x-shared.form-container action="save" enctype="multipart/form-data">
        <flux:input label="Name" wire:model.live="company.name" :invalid="$errors->has('company.name')" type="text"/>
        <flux:input label="Email" wire:model.live="company.email" :invalid="$errors->has('company.email')" type="email"/>
        <flux:input label="Website" wire:model.live="company.website" :invalid="$errors->has('company.website')" type="url"/>
        <flux:input label="Logo" wire:model.live="logo" :invalid="$errors->has('logo')" type="file"/>
        <!--
            ! wire:loading.attr="disabled" wire:target="logo"
            
            Ini berarti: saat proses upload file logo sedang berlangsung, tambahkan atribut disabled ke tombol
            wire:loading - mendeteksi saat ada proses loading/request yang sedang berjalan
            .attr="disabled" - menambahkan atribut HTML disabled saat loading
            wire:target="logo" - menentukan bahwa loading ini hanya dipicu khusus oleh properti logo
            Jadi, jika ada loading yang lain, tombol ini tidak akan terpengaruh\\
        -->
        <flux:button variant="primary" type="submit" wire:loading.attr="disabled" wire:target="logo">
        <!--
            wire:loading.remove wire:target="logo"

                Digunakan pada elemen <span>Save</span>
                Artinya: sembunyikan/hapus elemen ini saat file logo sedang diupload
                .remove - menginstruksikan elemen untuk dihapus dari DOM saat loading

        -->
            <span wire:loading.remove wire:target="logo">
                 Save
            </span>
        </flux:button>

        

    </x-shared.form-container>
</div>