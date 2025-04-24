<?php

namespace App\Services;

class NetPayCalculationsService
{
    /**
     * Create a new class instance.
     */
    public $gross_salary;
    public function __construct($gross_salary)
    {
        $this->gross_salary = $gross_salary;
    }

    public function getNssDeduction()
    {
        $max = 4320;

        return min($this->gross_salary, $max);
    }
    public function getShifDeduction(): float|int
    {
        return max($this->gross_salary * 0.0275, 300);
    }
    public function getAhlDeduction()
    {
        return $this->gross_salary * 0.015;
    }
    public function getDeductions()
    {
        return $this->getNssDeduction() + $this->getShifDeduction() + $this->getAhlDeduction();
    }
    public function getTaxableIncome()
    {
        return $this->gross_salary - ($this->getNssDeduction() + $this->getShifDeduction() + $this->getAhlDeduction());
    }
    public function getPaye()
    {
        $level1 = [288000 / 12, 0.1];
        $level2 = [388000 / 12, 0.25];
        $level3 = [6000000 / 12, 0.3];
        $level4 = [960000 / 12, 0.325];
        $level5 = [INF, 0.35];

        $taxableIncome = $this->getTaxableIncome();
        $paye = 0;

        if ($taxableIncome <= $level1[0]) {
            $paye = $taxableIncome * $level1[1];
        } elseif ($taxableIncome <= $level2[0]) {
            $paye = ($level1[0] * $level1[1]) + ($taxableIncome - $level1[0]) * $level1[1];
        } elseif ($taxableIncome <= $level3[0]) {
            $paye = ($level1[0] * $level1[1]) + ($level2[0] - $level1[0]) * $level1[1] + ($taxableIncome - $level2[0]) * $level2[1];
        } elseif ($taxableIncome <= $level4[0]) {
            $paye = ($level1[0] * $level1[1]) + ($level2[0] - $level1[0]) * $level1[1] + ($level3[0] - $level2[0]) * $level2[1] + ($taxableIncome - $level3[0]) * $level3[1];
        } elseif ($taxableIncome <= $level5[0]) {
            $paye = ($level1[0] * $level1[1]) + ($level2[0] - $level1[0]) * $level1[1] + ($level3[0] - $level2[0]) * $level2[1] + ($level4[0] - $level3[0]) * $level3[1] + ($taxableIncome - $level4[0]) * $level4[1];
        }
        $relief = 2400;
        $insuranceRelief = 0.15 * $this->getShifDeduction();
        $paye -= $relief;
        return max($paye, 0);
    }
    public function getNetPay()
    {
        $this->gross_salary - $this->getDeductions();
    }
}
