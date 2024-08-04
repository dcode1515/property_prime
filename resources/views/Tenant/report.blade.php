<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report</title>
    <style>
        /* Define your PDF styling here */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Payment Report</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Tenant</th>
                <th>Payment Date</th>
                <th>Amount</th>
                <th>Mode of Payment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $payment->invoice }}</td>
                    <td>{{ $payment->tenant->tenant_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->date_paid)->format('F j, Y') }}</td>
                    <td>₱{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->mode_of_payment }}</td>
                    <td>{{ $payment->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
