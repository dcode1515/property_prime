<template>
    <div>
        <div class="pageheader pd-t-25 pd-b-35">
            <div class="d-flex justify-content-between">
                <div class="clearfix">
                    <div class="pd-t-5 pd-b-5">
                        <h1 class="pd-0 mg-0 tx-20 tx-dark">
                            <i class="fa fa-building"></i>
                            <!-- Assuming 'fa-building' is the Font Awesome class for a building icon -->
                            Client List
                        </h1>
                    </div>
                    <div class="breadcrumb pd-0 mg-0">
                        <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Dashboard</a>
                        <a class="breadcrumb-item" href="">Memorial</a>
                        <span class="breadcrumb-item active">Client List</span>
                    </div>
                </div>
                <div class="d-flex align-items-center hidden-xs">
                    <button @click="openModal('add')" data-toggle="modal" class="btn btn-primary">
                        <span data-feather="plus" class="wd-16 mr-2"></span>Create Client
                    </button>
                </div>
            </div>
        </div>

        <div></div>

        <div class="row row-xs">
            <div class="col-sm-4">
                <div class="card mg-b-30">
                    <div class="card-body">
                        <div class="media d-inline-flex">
                            <div>
                                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Over All Client</span>
                                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                                    <span class="counter">{{ counts.overAll }}</span>
                                </h2>
                            </div>
                        </div>
                        <div class="clearfix">
                            <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span>
                            <span class="float-right">
                                <i class="ion-android-arrow-up mr-1 tx-success"></i><span class="tx-dark">92</span><span
                                    class="small mg-b-0">/100</span>
                            </span> -->
                        </div>
                        <div class="progress ht-3">
                            <div class="progress-bar bg-primary wd-90p" role="progressbar" aria-valuenow="90"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mg-b-30">
                    <div class="card-body">
                        <div class="media d-inline-flex">
                            <div>
                                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">No of Availed Client
                                </span>
                                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                                    <span class="counter">{{ counts.soldMemorial }}</span>
                                </h2>
                            </div>
                        </div>
                        <div class="clearfix">
                            <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span>
                            <span class="float-right">
                                <i class="ion-android-arrow-up mr-1 tx-success"></i><span class="tx-dark">95</span><span
                                    class="small mg-b-0">/100</span>
                            </span> -->
                        </div>
                        <div class="progress ht-3">
                            <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mg-b-30">
                    <div class="card-body">
                        <div class="media d-inline-flex">
                            <div>
                                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Sold
                                    Memorial</span>
                                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                                    <span class="counter">{{
                                        formatCurrency(counts.totalAmount)
                                    }}</span>
                                </h2>
                            </div>
                        </div>
                        <div class="clearfix">
                            <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span> -->
                            <!-- <span class="float-right">
                                <i class="ion-android-arrow-down mr-1 tx-danger"></i><span class="tx-dark">81</span><span
                                    class="small mg-b-0">/100</span>
                            </span> -->
                        </div>
                        <div class="progress ht-3">
                            <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mg-b-30">
            <div class="card-body">
                <div class="control float-left">
                    <div class="input-group vertical-input-group">
                        <select id="entries" v-model="tableData.length" @change="getData()" class="form-control">
                            <option v-for="(records, index) in perPage" :key="index" :value="records">
                                {{ records }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="control float-right">
                    <div class="input-group">
                        <input class="input form-control" type="text" v-model="tableData.search" placeholder="Search"
                            @input="getData()" />
                    </div>
                </div>
                <br /><br /><br />
                <div class="table-responsive">
                    <datatable v-if="data.length > 0" :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders"
                        @sort="sortBy">
                        <tbody>
                            <tr class="odd gradeX" v-for="(data, index) in data" :key="data.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ data.memorial.memorial_name }}</td>
                                <td>{{ data.customer_name }}</td>
                                <td>{{ data.customer_address }}</td>
                                <td>{{ data.date_paid }}</td>
                                <td>{{ data.mode_of_payment }}</td>
                                <td>{{ formatCurrency(data.amount_paid) }}</td>
                                <td>{{ data.status }} </td>
                                <td style="text-align: center">
                                    <a v-bind:href="'/lapmsv1/public/client/' +
                                        data.code_no +
                                        '/' +
                                        data.proof_of_payment
                                        " target="_blank">
                                        <i class="fa fa-file-pdf-o" style="color: red; font-size: 24px"></i>
                                    </a>
                                </td>

                                <td class="tx-center">
                                    <!-- <a v-bind:href="'/lapmsv1/update/memorial/' + data.id"
                      class="btn btn-success"
                      title="View"
                      data-toggle="tooltip"
                      data-placement="top"
                    >
                      <i class="fa fa-eye"> View</i>
                    </a> -->
                                    <button @click="openModal('edit', data)" class="btn btn-info" title="Edit"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-pencil"> Edit/View</i>
                                    </button>
                                    <button @click="confirmDelete(data.id)" class="btn btn-danger" title="Remove"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-trash"> Delete</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </datatable>
                    <div v-else>
                        <center>
                            <img :src="getImageUrl1()" alt="No Data Found" style="width: 300px" />
                        </center>
                    </div>
                    <!--Add Modal Start-->
                    <div class="modal fade bd-example-modal-xl" tabindex="-1" id="modalForumTopic" role="dialog"
                        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">
                                        {{ modalTitle }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        @click="closeModal">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="submitForm">
                                        <div class="row">
                                            <template v-if="modalMode === 'add'">


                                            </template>
                                        </div>
                                        <template v-if="modalMode === 'add'">
                                            <h6>
                                                <label>
                                                    <i class="fa fa-building"></i> Memorial Details</label>
                                            </h6>
                                        </template>
                                        <div class="row">
                                            <template v-if="modalMode === 'add'">
                                                <div class="col-md-12">
                                                    <label>Choose Memorial:</label>
                                                    <select class="form-control" v-model="formData.memorial_name">
                                                        <option value="">Select Memorial</option>
                                                        <option v-for="memorials in memorial" :key="memorials.id"
                                                            :value="memorials.id">
                                                            {{ memorials.memorial_name }} - {{ memorials.amount }} -

                                                            {{ memorials.rentedidle }}
                                                        </option>

                                                    </select>
                                                    <br>
                                                </div>
                                            </template>
                                            <hr>

                                            <div class="col-md-12">
                                                <h6>
                                                    <label>
                                                        <i class="fa fa-building"></i> Client Details</label>
                                                </h6>
                                                <label>Date Created:</label>
                                                <input type="date" class="form-control" v-model="formData.date_created"
                                                    placeholder="Enter Sq Meter" /><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Client Name:</label>
                                                <input type="text" class="form-control"
                                                    v-model="formData.client_name" /><br />

                                            </div>
                                            <div class="col-md-6">
                                                <label>Contact No:</label>
                                                <input type="number" class="form-control"
                                                    v-model="formData.contact_no" /><br />

                                            </div>

                                            <div class="col-md-12">
                                                <label>Address:</label>
                                                <textarea id="w3review" v-model="formData.address" class="form-control"
                                                    rows="4" cols="50" placeholder="Enter Address of Client">
                          </textarea><br />
                                            </div>
                                            <div class="col-md-12">
                                                <label>Mode of Payment</label>
                                                <select class="form-control" v-model="formData.mode_of_payment"
                                                    @change="handlePaymentModeChange">
                                                    <option value="G-Cash">G-Cash</option>
                                                    <option value="E-Payment">E-Payment</option>
                                                    <option value="Cash">Cash</option>
                                                </select><br>
                                            </div>
                                            <div class="col-md-4" v-if="formData.mode_of_payment !== 'Cash'">
                                                <label>
                                                    <span class="tx-danger">*</span>
                                                    Enter
                                                    <span v-if="formData.mode_of_payment === 'G-Cash'">G Cash</span>
                                                    <span
                                                        v-else-if="formData.mode_of_payment === 'E-Payment'">Account</span>
                                                    <span v-else>Account</span>
                                                    Number:
                                                </label>
                                                <input type="number" class="form-control" v-model="formData.acct_no" />
                                                <br />
                                            </div>

                                            <div class="col-md-4">
                                                <label><span class="tx-danger">*</span>Amount:</label>
                                                <input type="number" v-model="formData.amount" class="form-control" />
                                                <br />
                                            </div>
                                            <div class="col-md-4">
                                                <label><span class="tx-danger">*</span>Date Paid:</label>
                                                <input type="date" v-model="formData.date_paid" class="form-control" />
                                                <br />
                                            </div>
                                        </div>

                                        <template v-if="modalMode === 'add' || modalMode === 'edit'">
                                            <h6>
                                                <label>
                                                    <i class="fa fa-folder"></i>
                                                    Payment Attachment</label>
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Proof of Payment</label>
                                                    <input type="file" class="form-control"
                                                        @change="handleFileChange('proofofpayment')" /><br />
                                                </div>


                                            </div>
                                        </template>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button v-if="!viewMode" type="button" class="btn btn-primary" :disabled="isLoading"
                                        @click.prevent="submitForm">
                                        <span v-if="isLoading">
                                            <i class="fa fa-spinner"></i> Loading Please Wait
                                        </span>
                                        <span v-else>
                                            <i class="fa fa-check"></i>
                                            {{ modalMode === "add" ? "Create" : "Update" }}
                                            Client
                                        </span>
                                    </button>

                                    <!-- View button -->
                                    <button v-if="viewMode" type="button" class="btn btn-secondary"
                                        @click.prevent="closeModal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Large modal -->

                    <!--/ View Modal End-->

                    <pagination :pagination="pagination" @prev="getData(pagination.prevPageUrl)"
                        @next="getData(pagination.nextPageUrl)">
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import Swal from "sweetalert2";
import toastr from "toastr";
import "toastr/build/toastr.css";
import Datatable from "..//Datatable.vue";
import Pagination from "..//Pagination.vue";
export default {
    components: { datatable: Datatable, pagination: Pagination },
    methods: {
        handlePaymentModeChange() {
            // Handle additional logic when the payment mode changes
            // For example, you can clear the account number field if needed
            if (this.formData.mode_of_payment === "Cash") {
                this.formData.acct_no = "";
            }
        },
        getMemorial() {

            // You can use axios or any other library for the HTTP request
            axios
                .get("/lapmsv1/api/get/memorial")
                .then((response) => {
                    this.memorial = response.data;
                })
                .catch((error) => {
                    console.error("Error loading office heads", error);
                });
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

        formatDate(dateString) {
            const options = { year: "numeric", month: "long", day: "numeric" };
            const formattedDate = new Date(dateString).toLocaleDateString(
                "en-US",
                options
            );
            return formattedDate;
        },
        getProperty() {
            // You can use axios or any other library for the HTTP request
            axios
                .get("/lapmsv1/api/get/property")
                .then((response) => {
                    this.property = response.data;
                })
                .catch((error) => {
                    console.error("Error loading office heads", error);
                });
        },
        getImageUrl1() {
            return "/lapmsv1/public/images/nodatafound.png";
        },
        async confirmDelete(id) {
            try {
                // Display the confirmation dialog
                const result = await Swal.fire({
                    title: "Are you sure?",
                    text: "You will not be able to recover this Memorial!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true,
                });

                // If the user confirms
                if (result.isConfirmed) {
                    // Make the Axios POST request to delete the property
                    const response = await axios.post(`/lapmsv1/api/delete/client/${id}`);

                    // Handle success response as needed
                    console.log(response.data);

                    // Optionally, you can reload or update your component data after deletion
                    // this.$emit('propertyDeleted', id);

                    // Inform the user about the successful deletion
                    Swal.fire({
                        title: "Deleted!",
                        text: "Client has been deleted.",
                        icon: "success",
                    }).then(() => {
                        // Redirect to the desired URL after the user clicks "OK"
                        window.location.href = "/lapmsv1/client";
                    });
                }
            } catch (error) {
                // Handle error as needed
                console.error("Error deleting property:", error);

                // Inform the user about the error
                Swal.fire({
                    title: "Error!",
                    text: "There was an error deleting the property.",
                    icon: "error",
                });
            }
        },

        getImageUrl(image) {
            return (
                "/lapmsv1/public/property/furnishing/" +
                this.formData.propertyname +
                "/" +
                image
            );
        },
        getClientCounts() {
            axios
                .get("/lapmsv1/api/count/client")
                .then((response) => {
                    this.counts = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching property counts", error);
                });
        },

        handleFileChange(fileType) {
            // Update formData with the selected file
            this.formData[fileType] = event.target.files[0];
        },
        submitForm() {
            // Handle form submission based on the mode (add or edit)
            if (this.modalMode === "add") {
                // Add logic for creating a new property
                this.storeClient(
                    "/lapmsv1/api/store/client",
                    "Property successfully saved in the Database!"
                );
            } else {
                // Add logic for updating an existing property
                this.updateClient(
                    "/lapmsv1/api/update/client",
                    "Property successfully updated in the Database!"
                );
            }
        },

        openModal(mode, memorial) {
            // Reset the form data
            this.formData = {
                id: "",
                memorial_name: "",
                date_created: "",
                client_name: "",
                code_no: "",
                contact_no: "",
                address: "",
                mode_of_payment: "",
                acct_no: "",
                amount: "",
                date_paid: null,
                proofofpayment: null,


                // Reset other form fields as needed
            };

            // Set the modal mode
            this.modalMode = mode;

            // Set the modal title based on the mode
            this.modalTitle =
                mode === "add"
                    ? "Create New Client"
                    : mode === "edit"
                        ? "Edit Client"
                        : "View Tenant";

            if (mode === "edit" || mode === "view") {
                // Populate formData with property data for editing
                this.formData.id = memorial.id;
                this.formData.date_created = memorial.date_created;
                this.formData.code_no = memorial.code_no;
                this.formData.memorial_name = memorial.memorial_id;
                this.formData.client_name = memorial.customer_name;
                this.formData.contact_no = memorial.contact_number;
                this.formData.address = memorial.customer_address;
                this.formData.mode_of_payment = memorial.mode_of_payment;
                this.formData.acct_no = memorial.account_number;
                this.formData.amount = memorial.amount_paid;
                this.formData.date_paid = memorial.date_paid;

                // Populate other formData properties based on your property object
            }

            // Set the view mode flag
            this.viewMode = mode === "view";

            // Show the modal
            $("#modalForumTopic").modal("show");
        },

        closeModal() {
            // Close the modal
            $("#modalForumTopic").modal("hide");
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

        getData(url = "/lapmsv1/api/get/client") {
            this.tableData.draw++;

            axios
                .get(url, { params: this.tableData })
                .then((response) => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.configPagination(data.data);
                        this.data = data.data.data;
                    }
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, "name", key);
            this.tableData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
            this.getData();
        },
        getIndex(array, key, value) {
            return array.findIndex((i) => i[key] == value);
        },

        storeClient() {
            this.isLoading = true;
            const formData = new FormData();
            formData.append("memorial_name", this.formData.memorial_name);
            formData.append("date_created", this.formData.date_created);
            formData.append("client_name", this.formData.client_name);
            formData.append("contact_no", this.formData.contact_no);
            formData.append("address", this.formData.address);
            formData.append("mode_of_payment", this.formData.mode_of_payment);
            formData.append("acct_no", this.formData.acct_no);
            formData.append("amount", this.formData.amount);
            formData.append("date_paid", this.formData.date_paid);
            formData.append("proofofpayment", this.formData.proofofpayment);
            let delay = 2000;
            setTimeout(() => {
                axios
                    .post("/lapmsv1/api/store/client", formData)
                    .then((response) => {
                        if (response.status === 200) {
                            toastr.success(
                                "Client successfully Saved in the Database!",
                                "Success",
                                {
                                    timeOut: 10000,
                                    closeButton: true,
                                }
                            );
                            window.location.href = "/lapmsv1/client";
                        }
                    })
                    .catch((error) => {
                        if (error.response.status === 422 && error.response.data.errors) {
                            for (const field in error.response.data.errors) {
                                toastr.error(error.response.data.errors[field][0], "Error", {
                                    timeOut: 5000,
                                    closeButton: true,
                                });
                            }
                        } else if (
                            error.response.status === 422 &&
                            error.response.data.exist
                        ) {
                            toastr.error("Memorial Name:" + " " + this.formData.memorial_name + "Already exist", "Error", {
                                timeOut: 5000,
                                closeButton: true,
                            });
                        } else {
                            toastr.error(
                                "Something went wrong. Please try again later.",
                                "Error",
                                {
                                    timeOut: 5000,
                                    closeButton: true,
                                }
                            );
                            console.error("Error:", error);
                        }
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
            }, delay);
        },
        updateClient() {
            this.isLoading = true;
            const formData = new FormData();
            formData.append("code_no", this.formData.code_no);
            formData.append("date_created", this.formData.date_created);
            formData.append("client_name", this.formData.client_name);
            formData.append("contact_no", this.formData.contact_no);
            formData.append("address", this.formData.address);
            formData.append("mode_of_payment", this.formData.mode_of_payment);
            formData.append("acct_no", this.formData.acct_no);
            formData.append("amount", this.formData.amount);
            formData.append("date_paid", this.formData.date_paid);
            formData.append("proofofpayment", this.formData.proofofpayment);

            let delay = 2000;
            setTimeout(() => {
                axios
                    .post("/lapmsv1/api/update/client/" + this.formData.id, formData)
                    .then((response) => {
                        if (response.status === 200) {
                            toastr.success(
                                "Memorial successfully Updated in the Database!",
                                "Success",
                                {
                                    timeOut: 10000,
                                    closeButton: true,
                                }
                            );
                            window.location.href = "/lapmsv1/client";
                        }
                    })
                    .catch((error) => {
                        if (error.response.status === 422 && error.response.data.errors) {
                            for (const field in error.response.data.errors) {
                                toastr.error(error.response.data.errors[field][0], "Error", {
                                    timeOut: 5000,
                                    closeButton: true,
                                });
                            }
                        } else if (
                            error.response.status === 422 &&
                            error.response.data.exist
                        ) {
                            toastr.error("Memorial name already exist", "Error", {
                                timeOut: 5000,
                                closeButton: true,
                            });
                        } else {
                            toastr.error(
                                "Something went wrong. Please try again later.",
                                "Error",
                                {
                                    timeOut: 5000,
                                    closeButton: true,
                                }
                            );
                            console.error("Error:", error);
                        }
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
            }, delay);
        },
    },

    data() {
        let sortOrders = {};
        let columns = [
            { width: "0%", label: "No", name: "no" },
            { width: "15%", label: "Memorial", name: "memorial_name" },
            { width: "15%", label: "Client Name", name: "client_name" },
            { width: "10%", label: "Address", name: "address" },
            { width: "5%", label: "Date Paid", name: "date_paid" },
            { width: "5%", label: "Mode of Payment", name: "mode_of_payment" },
            { width: "10%", label: "Amount Paid", name: "amount" },
            { width: "8%", label: "Status", name: "status" },

            { width: "8%", label: "Proof of Payment", name: "Attachment" },

            { width: "12%", label: "Action", name: "action" },
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });
        return {
            memorial: [],
            viewMode: "",
            counts: {},
            modalMode: "add", // 'add' or 'edit'
            modalTitle: "Add New Property", // Default title for the modal

            formData: {
                id: "",
                memorial_name: "",
                date_created: "",
                client_name: "",
                contact_no: "",
                code_no: "",
                address: "",
                mode_of_payment: "",
                acct_no: "",
                amount: "",
                date_paid: "",
                proofofpayment: null, // File input for image1
            },
            selectedItemId: null,
            editData: {},

            tableData: {
                draw: 0,
                length: 10,
                search: "",
                column: 0,
                dir: "desc",
            },
            data: [],
            length: 10,
            search: "",
            payments: "",
            selected_user: [],
            current_page: [],
            error: "",
            columns: columns,
            sortKey: "borrower_no",
            sortOrders: sortOrders,
            perPage: ["10", "20", "30"],
            pagination: {
                lastPage: "",
                currentPage: "",
                total: "",
                lastPageUrl: "",
                nextPageUrl: "",
                prevPageUrl: "",
                from: "",
                to: "",
            },

            isLoading: false,
            errors: {},
        };
    },
    computed: {},
    created() {
        this.getData();
    },

    mounted() {
        this.getMemorial();
        this.getClientCounts();
        console.log("Component Mounted");
    },
};
</script>
  