<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payslip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 14px;
        }
        .header, .footer {
            text-align: center;
        }
        .header h2 {
            margin-bottom: 0;
        }
        .content {
            margin-top: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #000;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Slip Gaji</h2>
        <p>{{ $salary->payroll->company->name ?? 'Nama Perusahaan' }}</p>
        <p>Period: {{ $salary->payroll->month_string }}</p>
    </div>

    <div class="content">
        <div class="section">
            <h4>Employee</h4>
            <p>Name: {{ $salary->employee->name }}</p>
            <p>Email: {{ $salary->employee->email}}</p>
            <p>Position: {{ $salary->employee->designation->name}}</p>
        </div>

        <div class="section">
            <h4>Rincian Gaji</h4>
            <table class="table-bordered">
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>Gross Salary</td>
                    <td>${{ number_format($salary->gross_salary,2)}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
      <p>Printed On: {{ now()->format('d-m-Y') }}</p>

    </div>
</body>
</html>
