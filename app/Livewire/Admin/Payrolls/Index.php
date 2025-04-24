<?php

namespace App\Livewire\Admin\Payrolls;

use Livewire\Component;


use App\Models\Designation;
use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $monthYear;

    public function rules()
    {
        return [
            'monthYear' => 'required'
        ];
    }
    public function generatePayroll()
    {
        $this->validate();
        $date = Carbon::parse($this->monthYear);
        // ! Cek apakah payroll untuk bulan & tahun itu sudah ada → kalau ada: error
        if (Payroll::inCompany()->where('month', $date->format('m'))->where('year', $date->format('Y'))->exists()) {
            throw ValidationException::withMessages([
                'error' => 'Payroll already generated for this month.',
            ]);
        } else {
            // ! Buat record baru di tabel payrolls
            $payroll = new Payroll();
            $payroll->month = $date->format('m');
            $payroll->year = $date->format('Y');
            $payroll->company_id = session('company_id');
            $payroll->save();
            // ! Ambil semua karyawan di company
            foreach (Employee::inCompany()->get() as $employee) {
                $contract = $employee->getActiveContract(
                    $date->startOfMonth()->toDateString(),
                    $date->endOfMonth()->toDateString()
                );
                // ! Untuk setiap karyawan:
                // ! Cek apakah dia punya kontrak aktif dalam periode tersebut
                // ! Kalau ada → buat record salary dengan gross_salary sesuai total penghasilan dari kontrak
                if ($contract) {
                    $payroll->salaries()->create([
                        'employee_id' => $employee->id,
                        'gross_salary' => $contract->getTotalEarnings(
                            $date->format('Y-m')
                        )
                    ]);
                }
                session()->flash('success', 'Payroll generated successfully.');
            }
        }
    }
    public function updatePayroll($id)
    {
        // ! Cari payroll by ID (harus milik company yang sedang login)
        $payroll = Payroll::inCompany()->find($id);
        // ! Hapus semua salary yang sudah ada sebelumnya
        $payroll->salaries()->delete();
        // ! Ulangi proses generate seperti sebelumnya: ambil semua employee → cari kontrak aktif → hitung gaji → isi kembali salaries
        foreach (Employee::inCompany()->get() as $employee) {
            $contracts = $employee->getActiveContract(
                $payroll->year . '-' . $payroll->month . '-01',
                $payroll->year . '-' . $payroll->month . '-31'
            );
            $payroll->salaries()->create([
                'employee_id' => $employee->id,
                'gross_salary' => $contracts->getTotalEarnings(
                    $payroll
                )
            ]);
        }
    }
    public function viewPayroll($payrollId)
    {
        $payroll = Payroll::inCompany()->find($payrollId);
        if (!$payroll) {
            session()->flash('error', 'Payroll not found.');
            return $this->redirectIntended(route('payrolls.index'), true);
        }
        $this->redirectIntended(route('payrolls.show', $payroll), true);
    }

    public function render()
    {

        return view('livewire.admin.payrolls.index', [
            'payrolls' => Payroll::inCompany()->paginate(5),
        ]);
    }
}
