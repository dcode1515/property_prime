<template>
    <div>
        <div class="pageheader pd-t-25 pd-b-35">
            <div class="d-flex justify-content-between">
                <div class="clearfix">
                    <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20 tx-dark">
                            <i class="fa fa-credit-card"></i>
                            <!-- Assuming 'fa-building' is the Font Awesome class for a building icon -->
                            Report
                        </h1>
                    </div>
                    <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Dashboard</a>
                        <a class="breadcrumb-item" href="">Report</a>
                        <span class="breadcrumb-item active">Real State</span>
                    </div>
                </div>
            </div>
        </div>




        <button type="button" class="btn btn-info" id="dateButton">
            <i class="fa fa-calendar"></i> Date Today: <span id="currentDate">{{ currentDate }}</span>
        </button>

        <br />
        <br />
        <div class="row">
            <div class="col-md-3">
                <label>Report Type</label>
                <select class="form-control" v-model="report_type">
                    <option value="All">All</option>
                    <option value="Daily Income">Daily Income</option>
                    <option value="Monthly Income">Monthly Income</option>
                    <option value="Yearly Income">Yearly Income</option>
                    <option value="Customize">Customize</option>
                </select>
            </div>
            <template v-if="report_type === 'Customize'">
                <div class="col-md-3">
                    <label>Date From</label>
                    <input type="date" class="form-control" v-model="start_date">

                </div>
                <div class="col-md-3">
                    <label>Date To</label>
                    <input type="date" class="form-control" v-model="start_to">
                </div>
            </template>
            <div class="col-md-3">
                <label>Mode of Payment</label>
                <div class="input-group">
                    <select class="form-control" v-model="mode_of_payment">
                        <option value="All">All</option>
                        <option value="G-Cash">G-Cash</option>
                        <option value="E-Payment">E-Payment</option>
                        <option value="Cash">Cash</option>

                    </select>

                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger" @click="viewData"><i class="fa fa-eye">View
                                Data</i></button>
                        <button type="button" class="btn btn-info" @click="printReport"><i class="fa fa-print">Print
                                Report</i></button>
                    </div>
                    <iframe v-if="pdfContent" :srcdoc="pdfContent" width="100%" height="600px"></iframe>
                </div>
            </div>
        </div>


        <br>

        <label> <strong>Payment List</strong></label>
        <div class="card mg-b-30">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- Add table headers based on your payment data structure -->
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Tenant</th>
                                <th>Payment Date</th>
                                <th>Amount</th>
                                <th>Mode of Payment</th>
                                <th>Status</th>
                                <!-- Add more headers if needed -->
                            </tr>
                        </thead>
                        <tbody v-if="filteredPayments.length > 0">

                            <tr v-for="(payment, index) in filteredPayments" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ payment.invoice }}</td>
                                <td>{{ payment.tenant.tenant_name }}</td>
                                <td>{{ formatDate(payment.date_paid) }}</td>
                                <td>{{ formatCurrency(payment.amount) }}</td>
                                <td>{{ payment.mode_of_payment }}</td>
                                <td>{{ payment.status }}</td>
                                <!-- Add more columns based on your payment data structure -->
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="7"><br><br><br><br>
                                    <center>
                                        <img :src="getImageUrl1()" alt="No Data Found" style="width: 400px" />
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <br />
                </div>
            </div>
        </div>
    </div>
</template>
  
  
<script>

export default {

    methods: {
        // printReport() {
        //     axios.post('/lapmsv1/api/get/data/payment', {
        //         report_type: this.report_type,
        //         start_date: this.start_date,
        //         start_to: this.start_to,
        //         mode_of_payment: this.mode_of_payment,
        //         generate_pdf: true, // Add this flag to generate PDF
        //     })
        //         .then(response => {
        //             // PDF is generated and streamed, no need to handle the response
        //             window.open('/lapmsv1/api/get/data/payment/pdf', '_blank');
        //         })
        //         .catch(error => {
        //             console.error('Error generating PDF report:', error);
        //         });
        // },
        getImageUrl1() {
            return "/lapmsv1/public/images/nodatafound.png";
        },
        viewData() {
            this.filterData(false); // Pass false to indicate not generating PDF
        },
        printReport() {
            this.filterData(true); // Pass true to indicate generating PDF
        },
        filterData(generatePdf) {
            const requestData = {
                report_type: this.report_type,
                start_date: this.start_date,
                start_to: this.start_to,
                mode_of_payment: this.mode_of_payment,
            };

            if (generatePdf) {
                requestData.generate_pdf = true;
            }

            axios.post('/lapmsv1/api/get/data/payment', requestData)
                .then(response => {
                    if (generatePdf) {
                        // PDF is generated and streamed, no need to handle the response
                        window.open('/lapmsv1/api/get/data/payment/pdf', '_blank');
                    } else {
                        // Update your component state with the data received from the server
                        this.filteredPayments = response.data;
                    }
                })
                .catch(error => {
                    console.error(generatePdf ? 'Error generating PDF report:' : 'Error fetching filtered payments:', error);
                });
        },
        generateAndOpenPDF() {
            this.filterData();
            console.log(this.filteredPayments);

            // Assuming you have a method to generate PDF in your backend
            axios.post('/lapmsv1/api/generate/pdf', {
                // Pass necessary data for PDF generation
                report_type: this.report_type,
                start_date: this.start_date,
                start_to: this.start_to,
                mode_of_payment: this.mode_of_payment,
                filteredPayments: this.filteredPayments, // Pass the filtered data
            }, {
                responseType: 'arraybuffer',  // Set the response type to arraybuffer
            })
                .then(response => {
                    // Create a Blob from the response data
                    const blob = new Blob([response.data], { type: 'application/pdf' });

                    // Create a URL for the Blob and open it in a new tab
                    const url = window.URL.createObjectURL(blob);
                    window.open(url, '_blank');

                    // Optional: Revoke the Blob URL after opening the new tab
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => {
                    console.error('Error generating PDF:', error);
                });
        },



        getCurrentDate() {
            const today = new Date();
            const options = { year: "numeric", month: "long", day: "numeric" };
            return today.toLocaleDateString("en-US", options);
        },
        updateCurrentDate() {
            // Get the current date and format it as you desire
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);

            // Update the data property
            this.currentDate = formattedDate;
        },
        getCurrentYear() {
            const currentDate = new Date();
            return currentDate.getFullYear();
        },
        formatCurrency(amount) {
            // Check if amount is defined and not null
            if (amount !== undefined && amount !== null) {
                // Convert amount to a number and format it with commas and 2 decimal places
                return Number(amount).toLocaleString("en-US", {
                    style: "currency",
                    currency: "PHP",
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
            } else {
                return "";
            }
        },
        formatNumberWithCommas(number) {
            // Convert number to string
            let numberString = String(number);

            // Split the string into integer and decimal parts
            let parts = numberString.split(".");
            let integerPart = parts[0];
            let decimalPart = parts.length > 1 ? "." + parts[1] : "";

            // Add commas to the integer part
            let formattedIntegerPart = integerPart.replace(
                /\B(?=(\d{3})+(?!\d))/g,
                ","
            );

            // Concatenate the formatted integer part and the decimal part
            return formattedIntegerPart + decimalPart;
        },
        formatDate(dateString) {
            const options = { year: "numeric", month: "long", day: "numeric" };
            const formattedDate = new Date(dateString).toLocaleDateString(
                "en-US",
                options
            );
            return formattedDate;
        },

        getImageUrl1() {
            return "/lapmsv1/public/images/nodatafound.png";
        },





    },

    data() {
        let sortOrders = {};
        let columns = [
            { width: "0%", label: "No", name: "id" },

            { width: "10%", label: "Tenant Name", name: "tenant_name" },
            { width: "5%", label: "Contact No.", name: "contact_noumber" },
            { width: "5%", label: "Monthly Rate", name: "rate" },
            { width: "8%", label: "Lease Period", name: "lease_period" },
            { width: "7%", label: "Due Date", name: "duedate" },
            { width: "7%", label: "No of Payment", name: "no_of_payment" },
            { width: "5%", label: "Status", name: "status" },
            { width: "5%", label: "Action", name: "action" },
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });
        return {
            pdfContent: null,
            report_type: 'All',
            start_date: '',
            start_to: '',
            mode_of_payment: 'All',
            filteredPayments: [],
            currentDate: this.getCurrentDate(),



        };

    },
    computed: {},
    created() {

    },

    mounted() {
        this.filterData();
        this.updateCurrentDate();

        // Optionally, you can set up an interval to update the date every minute
        setInterval(this.updateCurrentDate, 60000);

        console.log("Component Mounted");
    },
};
</script>
  
<style scoped>
notification-button .fa-bell {
    transition: transform 0.5s ease-in-out;
}

.notification-button:hover .fa-bell {
    transform: rotate(360deg);
}

.animated-bell {
    animation: bellAnimation 1s infinite;
}

@keyframes bellAnimation {
    0% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-5px);
    }

    100% {
        transform: translateY(0);
    }
}
</style>
  
  