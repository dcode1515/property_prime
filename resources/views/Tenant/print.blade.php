<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .logo img {
            width: 200px;
            display: block;
            margin: 0 auto;
        }

        .property-section,
        .tenant-section {
            width: 50%;
            float: left;
        }

        .tenant-section {
            float: right;
        }

        .section-header {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .date-info {
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            border-spacing: 0;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .total-amount {
            float: right;
            margin-top: 20px;
            font-weight: bold;
        }

        @media print {
            body {
                font-size: 10pt;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="logo">
            <img src="{{ URL::asset('public/images/logo.png') }}" alt="Logo" />
        </div>
        <hr>

        <div class="tenant-section">
            <div class="date-info">
                Date Printed: {{ now()->format('M d Y') }}<br>
                Due Date: {{ $tenant->duedate->format('M d Y') }}
            </div>
        </div>

        <div class="property-section">
            <div class="section-header">Property</div>
            Property Name: {{ $tenant->property->property_name }}<br>
            Address: {{ $tenant->property->complete_address }}<br><br>
            <div class="section-header">Tenant</div>
            Tenant Name: {{ $tenant->tenant_name }}<br>
            Monthly Payment: {{ $tenant->rate }}
        </div>
        <br><br><br><br><br><br><br><br>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Invoice #</th>
                    <th scope="col">Date Paid</th>
                    <th scope="col">Mode of Payment</th>
                    <th scope="col">Account No/G-cash</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Paid</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                    $rowCount = 0;
                @endphp

                @foreach ($tenantpayment as $data)
                    <tr>
                        <td>{{ $data->invoice }}</td>
                        <td>{{ $data->date_paid }}</td>
                        <td>{{ $data->mode_of_payment }}</td>
                        <td>{{ $data->acctno }}</td>
                        <td>{{ number_format($data->amount, 2) }}</td>
                        <td>{{ $data->status }}</td>
                    </tr>
                    @php
                        $totalAmount += $data->amount;
                        $rowCount++;
                    @endphp
                @endforeach

            </tbody>
        </table>

        <div class="total-amount">
            <p>Total Amount: PHP {{ number_format($totalAmount, 2) }}</p>
        </div>
    </div>

</body>

</html>
