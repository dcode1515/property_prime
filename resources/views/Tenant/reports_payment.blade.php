@extends('layouts.template')

@section('content')
    <div class="page-inner">
        <div id="main-wrapper">
            <div class="pageheader pd-t-25 pd-b-35">
                <div class="d-flex justify-content-between">
                    <div class="clearfix">
                        <div class="pd-t-5 pd-b-5">
                            <h1 class="pd-0 mg-0 tx-20 tx-dark">
                                <i class="fa fa-credit-card"></i> Report
                            </h1>
                        </div>
                        <div class="breadcrumb pd-0 mg-0">
                            <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i>
                                Dashboard</a>
                            <a class="breadcrumb-item" href="#">Report</a>
                            <span class="breadcrumb-item active">Real State</span>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-info" id="dateButton">
                <i class="fa fa-calendar"></i> Date Today: <span id="currentDate"></span>
            </button>

            <br />
            <br />
            <div class="row">
                <div class="col-md-3">
                    <label>Report Type</label>
                    <select class="form-control" name="report_type">
                        <option value="All">All</option>
                        <option value="Daily Income">Daily Income</option>
                        <option value="Monthly Income">Monthly Income</option>
                        <option value="Yearly Income">Yearly Income</option>
                        <option value="Customize">Customize</option>
                    </select>
                </div>

                <div class="col-md-3 date-inputs"> <!-- Hide by default -->
                    <label>Date From</label>
                    <input type="date" class="form-control" name="start_date">
                </div>

                <div class="col-md-3 date-inputs"> <!-- Hide by default -->
                    <label>Date To</label>
                    <input type="date" class="form-control" name="start_to">
                </div>


                <div class="col-md-3">
                    <label>Mode of Payment</label>
                    <div class="input-group">
                        <select class="form-control" name="mode_of_payment">
                            <option value="All">All</option>
                            <option value="G-Cash">G-Cash</option>
                            <option value="E-Payment">E-Payment</option>
                            <option value="Cash">Cash</option>
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger" id="viewDataButton"><i class="fa fa-eye"></i> View
                                Data</button>
                            <button type="button" class="btn btn-info" id="printDataButton"><i class="fa fa-print"></i>
                                Print Report</button>

                        </div>
                    </div>
                </div>
            </div>

            <br>

            <label><strong>Payment List</strong></label>
            <div class="card mg-b-30">

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="paymentTable">
                            <thead>
                                <tr>
                                <tr id="companyInfoRow">
                                    <th colspan="7">
                                        <div id="companyInfoRow" style="text-align: center;">
                                            <h3>Company Logo</h3>
                                            <label>Company Name</label><br>
                                            <label>Company Address</label>
                                            <p style="text-align: left;"><strong>Mode of Payment:</strong> <span
                                                id="modeOfPaymentLabel"></span></p>
                                            <p style="text-align: left;"><strong>Report Type:</strong> <span
                                                    id="reportTypeLabel"></span></p>
                                           
                                            <p id="dateRangeLabel" style="text-align: left;"></p>
                                        </div>
                    </div>
                    </th>
                    </tr>

                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tenant</th>
                    <th>Payment Date</th>
                    <th>Mode of Payment</th>
                    <th>Status</th>
                    <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody id="paymentTableBody">
                        <!-- Data will be dynamically added here -->
                    </tbody>
                    </table>
                    <br />
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>


    <script>
        $(document).ready(function() {
            // Function to show/hide date inputs based on report type
            function toggleDateInputs() {
                var reportType = $('select[name="report_type"]').val();
                if (reportType === 'Customize') {
                    $('.date-inputs').show();
                } else {
                    $('.date-inputs').hide();
                }
            }

            // Function to update the payment table with data
            function formatDate(dateString) {
                var options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return new Date(dateString).toLocaleDateString(undefined, options);
            }

            // Function to format currency
            function formatCurrency(amount) {
                // Convert amount to number and round to two decimal places
                var roundedAmount = parseFloat(amount).toFixed(2);

                // Format the amount with commas for every three digits
                var formattedAmount = parseFloat(roundedAmount).toLocaleString('en-US');

                // Add currency symbol
                return '₱' + formattedAmount;
            }

            function updateTable(data) {
                var tableBody = $('#paymentTableBody');
                tableBody.empty();

                if (data.length > 0) {
                    $.each(data, function(index, payment) {
                        // Format date using the formatDate function
                        var formattedDate = formatDate(payment.date_paid);

                        // Format amount using the formatCurrency function
                        var formattedAmount = formatCurrency(payment.amount);

                        var newRow = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + payment.invoice + '</td>' +
                            '<td>' + payment.tenant.tenant_name + '</td>' +
                            '<td>' + formattedDate + '</td>' +
                            '<td>' + payment.mode_of_payment + '</td>' +
                            '<td>' + payment.status + '</td>' +
                            '<td>' + formattedAmount + '</td>' +
                            '</tr>';
                        tableBody.append(newRow);
                    });
                } else {
                    var noDataRow =
                        '<tr><td colspan="7" class="text-center" style="font-weight: bold; color: #888;">No data found</td></tr>';
                    tableBody.append(noDataRow);
                }
            }

            // Hide date inputs on page load
            $('.date-inputs').hide();

            // Event listener for report type change
            $('select[name="report_type"]').on('change', function() {
                toggleDateInputs();
            });

            $('#viewDataButton').on('click', function() {
                var reportType = $('select[name="report_type"]').val();
                var modeOfPayment = $('select[name="mode_of_payment"]').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token

                // Include start_date and start_to when Customize is selected
                var data = {
                    report_type: reportType,
                    mode_of_payment: modeOfPayment,
                    // Include other necessary parameters if needed
                };

                if (reportType === 'Customize') {
                    data.start_date = $('input[name="start_date"]').val();
                    data.start_to = $('input[name="start_to"]').val();
                }

                $.ajax({
                    url: '/lapmsv1/api/get/data/payment',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken, // Include CSRF token in headers
                    },
                    dataType: 'json',
                    success: function(response) {
                        updateTable(response);
                    },
                    error: function(error) {
                        console.error('Error fetching filtered payments:', error);
                    }
                });
            });

            $(document).ready(function() {
                // Hide the company details row initially
                $('#companyInfoRow').hide();

                // Event listener for report type change
                $('select[name="report_type"]').on('change', function() {
                    toggleDateInputs();
                });

                // Event listener for the "Print Report" button
                $('#printDataButton').on('click', function() {
                    printTable();
                });
            });

            // Function to print the table
            function printTable() {
                var reportType = $('select[name="report_type"]').val();
                var modeOfPayment = $('select[name="mode_of_payment"]').val();

                // Get the selected report type and mode of payment
                var selectedReportType = $('select[name="report_type"] option:selected').text();
                var selectedModeOfPayment = $('select[name="mode_of_payment"] option:selected').text();

                // Set the Report Type and Mode of Payment labels
                $('#reportTypeLabel').text(selectedReportType);
                $('#modeOfPaymentLabel').text(selectedModeOfPayment);

                // Check if PDF generation is required
                if (reportType !== 'All' && reportType === 'All') {
                    // Open a new window to display the PDF
                    var apiUrl = '/lapmsv1/api/get/data/payment?mode_of_payment=' + modeOfPayment + '&pdf=1';

                    window.open(apiUrl, '_blank');
                } else {
                    // Get the selected report type and mode of payment
                    var selectedReportType = $('select[name="report_type"] option:selected').text();
                    var selectedModeOfPayment = $('select[name="mode_of_payment"] option:selected').text();

                    // Get the selected dates if Customize is selected
                    var startDate = $('input[name="start_date"]').val();
                    var endDate = $('input[name="start_to"]').val();

                  

                    var grandtotal = 0;

                    // Calculate overall total
                    $('#paymentTableBody tr').each(function() {
                        var amount = parseFloat($(this).find('td:eq(6)').text().replace('₱', '').replace(
                            ',', ''));
                        if (!isNaN(amount)) {
                            grandtotal += amount;
                        }
                    });
                    // Set the Date Range label for Customize report type
                    var startDate = $('input[name="start_date"]').val();
                    var endDate = $('input[name="start_to"]').val();

                    // Format start date
                    var formattedStartDate = startDate ? formatDate(new Date(startDate)) : '';

                    // Format end date
                    var formattedEndDate = endDate ? formatDate(new Date(endDate)) : '';

                    var dateRangeLabel = startDate && endDate ? `As Of:  ${formattedStartDate} to ${formattedEndDate}` : '';
                    $('#dateRangeLabel').text(dateRangeLabel);

                    

                    $('#paymentTable tfoot').remove(); // Remove existing footer if any
                    $('#paymentTable').append(`
            <tfoot>
                <tr>
                    <td colspan="3">Prepared By: ${'{{ auth()->user()->name }}'}</td>
                    <td></td>
                    <td></td>
                    <td><strong>Total Income:</strong></td>
                    <td><strong>${formatCurrency(grandtotal)}</strong></td>
                </tr>
            </tfoot>
        `);

                    // Show the company details row
                    $('#companyInfoRow').show();

                    printJS({
                        printable: 'paymentTable',
                        type: 'html',
                        style: `
                .table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                    font-size: 12px; /* Adjust font size */
                }
                th {
                    background-color: green; /* Header background color */
                }
            `,
                        // Add the title content and Grandtotal above the table
                        onPrintDone: function() {
                            // Hide the company details row after printing
                            $('#companyInfoRow').hide();
                            // Remove the Prepared By and Grand Total footer
                            $('#paymentTable tfoot').remove();
                        }
                    });
                }
            }


            // Event listener for report type change
            $('select[name="report_type"]').on('change', function() {
                toggleDateInputs();
            });

            // Event listener for the "Print Report" button
            $('#printDataButton').on('click', function() {
                printTable();
            });
        });
    </script>
    <style>
        @media print {
            #companyInfo {
                page-break-before: always;
                /* Add a page break before companyInfo when printing */
            }

            /* Add any additional styles for printing */
        }
    </style>
@endsection
