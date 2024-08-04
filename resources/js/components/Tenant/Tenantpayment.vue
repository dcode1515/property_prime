<template>
  <div class="page-inner pd-0-force mg-0-force bg-white">
    <div class="row no-gutters pd-b-30 pd-t-30 wd-100p clearfix">
      <!--================================-->
      <!--  Invoice Start -->
      <!--================================-->
      <div class="card pd-20 wd-90p m-auto">
        <img :src="getLogo()" class="img-fluid" style="width:160px" alt="logo">

        <!-- <h5 class="card-title bd-b pd-y-20">
          Tenant Payment List : {{ tenantname }}
        </h5> -->
        <hr>
        <div class="card-body pd-0 printing-area">
          <div class="row">
            <div class="col-md-3">
              <address>

                <strong>{{ tenantname }}</strong><br />
                {{ address }}<br />
                {{ contactno }}<br />
                <abbr title="Email">Monthly Payment: </abbr>
                {{ formatNumberWithCommas(rate) }}
                <br />
                <abbr title="Phone">Lease Period:</abbr> {{ period }}
                <br />
              </address>
            </div>
            <div class="col-md-3 ml-md-auto text-md-right">
              <h4 class="text-dark">Property</h4>
              <address>
                <strong>{{ propertyname }}</strong><br />
                Address: {{ completeaddress }}<br />
                Monthly Rate: {{ formatNumberWithCommas(monthly) }}<br />
                <abbr title="Email">Status: </abbr> {{ statustype }}
                <br />
              </address>
              <br /><br />
              <span><strong>Date Today:</strong> {{ currentDate }}</span>
              <br />
              <span><strong>Due Date:</strong> {{ formatDate(duedate) }}</span>
              <br /><br /><br />
            </div>
          </div>
          <div class="control float-right mt-3">
            <div class="input-group">
              <!-- Search input -->
              <input class="input form-control" v-model="searchQuery" type="text" placeholder="Search">
            </div>
          </div>

          <div class="control float-left mt-3">
            <div class="input-group">
              <!-- Dropdown filter by mode of payment -->
              <label class="mr-2">Filter By</label>
              <select class="form-control" v-model="selectedMode">
                <option value="All">All</option>
                <option value="G-Cash">G-Cash</option>
                <option value="Bank Deposit">Bank Deposit</option>
                <option value="E-Payment">E-Payment</option>
                <option value="Cash">Cash</option>
              </select><br><br><br>
            </div>
          </div>




          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Invoice No</th>
                  <th>Date Paid</th>
                  <th>Mode of Payment</th>
                  <th>Acct No/G-Cash Number</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Check if there are payments in the paginatedPayments array -->
                <template v-if="paginatedPayments.length > 0">
                  <!-- Loop through paginatedPayments array and dynamically generate rows -->
                  <!-- <tr v-for="(paymentItem, index) in paginatedPayments" :key="index"> -->
                    <tr v-for="(paymentItem, index) in sortedPayments" :key="index" :class="{ 'highlight-row': index === 0 }">
                    <td>{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
                    <td>{{ paymentItem.invoice }}</td>
                    <td>{{ formatDate(paymentItem.date_paid) }}</td>
                    <td>{{ paymentItem.mode_of_payment }}</td>
                    <td>{{ paymentItem.acctno }}</td>
                    <td>{{ formatCurrency(paymentItem.amount) }}</td>
                    <td>
                      <span class="badge badge-outline-success">{{ paymentItem.status }}</span>
                    </td>
                    <td>
                      <button @click="openModal('edit', paymentItem)" class="btn btn-info" title="Edit"
                        data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-pencil"> Edit</i>
                      </button>
                    </td>
                  </tr>
                </template>
                <!-- If no payments found, display a message -->
                <tr v-if="paginatedPayments.length === 0">
                  <td colspan="7" class="text-center">No Payments Available</td>
                </tr>
              </tbody>
            </table>


          </div>
          <div class="text-center mt-3">
            <span class="mx-2">Page {{ currentPage }} out of {{ totalPages }}</span>
            <button @click="prevPage" :disabled="currentPage === 1" class="btn btn-outline-primary">
              <i class="fa fa-chevron-left"></i> Previous Page
            </button>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="btn btn-outline-primary">
              Next Page <i class="fa fa-chevron-right"></i>
            </button>
          </div>


          <hr />
          <div class="row">
            <div class="col-md-6 alert alert-primary" role="alert">
              <h5><i class="fa fa-exclamation-triangle"></i> Note:</h5>
              <p>
                kindly review the proof of payment and validate the accuracy of
                the account or GCash number. Before you submit the payment of
                the tenant
              </p>
            </div>
            <div class="col-md-4 ml-md-auto text-right">
              <!-- <span class="d-inline-block">
                Sub - Total amount: $2,230
                <p class="tx-gray-500 tx-12">VAT (10%): $22.3</p>
              </span>
              -->
              <br /><br />
              <p class="tx-bold">
                Grand Total:
                <span class="tx-20 tx-gray-900">{{
                  formatCurrency(grandTotal)
                }}</span>
              </p>
              <br />
            </div>
          </div>
          <hr />
          <div class="text-right mg-y-20">
            <button type="submit" class="btn btn-primary mg-t-5" @click="openModal('add')">
              <i class="fa fa-dollar"></i> Proceed to payment
            </button>
            <a v-bind:href="'/lapmsv1/print/payment/' + this.id" target="_balnk" class="btn btn-success mg-t-5">
              <i class="fa fa-print"></i> Print
            </a>
            <a v-bind:href="'/lapmsv1/tenant/payment'" class="btn btn-danger mg-t-5">
              <i class="fa fa-arrow-left"></i> Back to Payment
            </a>
          </div>
        </div>
      </div>
      <!--/ Invoice End -->
      <div class="modal fade effect-scale" id="modalForumTopic" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ tenantname }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                <i data-feather="x"></i>
              </button>
            </div>
            <div class="modal-body pd-y-20">
              <div v-if="modalMode === 'edit' || modalMode === 'add'">
                <form @submit.prevent="submitForm">
                  <!-- Form fields for property details -->
                  <div class="row">
                    <div class="col-md-12">
                      <label>Invoice Number: {{ rounded }}</label><br />
                      <label>Monthly Payment: {{ rate }}</label><br /><br />
                
                      <label><span class="tx-danger">*</span>Date Paid:</label>
                      <input type="date" v-model="formData.date_paid" class="form-control" />
                      <br />
                    </div>
                    <div class="col-md-12">
                      <label><span class="tx-danger">*</span>Mode of Payment:</label>
                      <select class="form-control" v-model="formData.paymentmode" @change="handlePaymentModeChange">
                        <option value="G-Cash">G-Cash</option>
                        <option value="E-Payment">E-Payment</option>
                        <option value="Bank Deposit">Bank Deposit</option>
                        <option value="Cash">Cash</option>
                      </select>
                      <br />
                    </div>

                    <div class="col-md-12" v-if="formData.paymentmode !== 'Cash'">
                      <label>
                        <span class="tx-danger">*</span>
                        Enter
                        <span v-if="formData.paymentmode === 'G-Cash'">G Cash</span>
                        <span v-else-if="formData.paymentmode === 'E-Payment'">Account</span>
                        <span v-else>Account</span>
                        Number:
                      </label>
                      <input type="number" class="form-control" v-model="formData.accountNumber" />
                      <br />
                    </div>

                    <div class="col-md-12">
                      <label><span class="tx-danger">*</span>Amount:</label>
                      <input type="number" v-model="formData.amount" class="form-control" />
                      <br />
                    </div>

                    <div class="col-md-12">
                      <label class="form-control-label"><span class="tx-danger">*</span>Proof of
                        Payment:</label>
                      <input type="file" class="form-control" @change="handleFileChange('proofofpayment')" />
                    </div>
                  </div>

                  <!-- Submit button -->
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button v-if="!viewMode" type="button" class="btn btn-primary" :disabled="isLoading"
                @click.prevent="submitForm">
                <span v-if="isLoading">
                  <i class="fa fa-spinner"></i> Loading Please Wait
                </span>
                <span v-else>
                  <i :class="modalMode === 'add' ? 'fa fa-check' : 'fa fa-pencil'"></i>
                  {{ modalMode === 'add' ? 'Submit' : 'Update' }} Payment
                </span>
              </button>

              <!-- View button -->
              <button v-if="viewMode" type="button" class="btn btn-secondary" @click.prevent="closeModal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import toastr from "toastr";
import "toastr/build/toastr.css";
export default {
  props: {
    payment: Array,

    id: {
      type: Number,
      required: true,
    },
    tenantname: {
      type: String,
      required: true,
    },
    tenantno: {
      type: String,
      required: true,
    },
    contactno: {
      type: String,
      required: true,
    },
    address: {
      type: String,
      required: true,
    },
    rounded: {
      type: String,
      required: true,
    },
    rate: {
      type: String,
      required: true,
    },
    period: {
      type: String,
      required: true,
    },
    duedate: {
      type: String,
      required: true,
    },
    propertyname: {
      type: String,
      required: true,
    },
    completeaddress: {
      type: String,
      required: true,
    },
    monthly: {
      type: String,
      required: true,
    },
    statustype: {
      type: String,
      required: true,
    },
    propertyid: {
      type: Number,
      required: true,
    },
  },
  methods: {
    formatDate(dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      const formattedDate = new Date(dateString).toLocaleDateString(
        "en-US",
        options
      );
      return formattedDate;
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      const totalPages = Math.ceil(this.filteredPayment.length / this.itemsPerPage);
      if (this.currentPage < totalPages) {
        this.currentPage++;
      }
    },

    formatPaymentDate(dateString) {
      // You can use a date formatting library or built-in JavaScript Date functions here
      return dateString ? new Date(dateString).toLocaleDateString() : "";
    },
    // Example method to format currency (customize as needed)
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

    handleFileChange(fileType) {
      // Update formData with the selected file
      this.formData[fileType] = event.target.files[0];
    },
    submitForm() {
      // Handle form submission based on the mode (add or edit)
      if (this.modalMode === "add") {
        // Add logic for creating a new property
        this.storeTenant(
          "/lapmsv1/api/store/tenant/payment",
          "Tenant Payment successfully saved in the Database!"
        );
      } else {
        // Add logic for updating an existing property
        this.updateTenant(
          "/lapmsv1/api/update/tenant/payment",
          "Tenant Payment successfully updated in the Database!"
        );
      }
    },

    storeTenant() {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("tenantname", this.tenantname);
      formData.append("tenantno", this.tenantno);
      formData.append("id", this.id);
      formData.append("propertyid", this.propertyid);
      formData.append("paymentmode", this.formData.paymentmode);
      formData.append("date_paid", this.formData.date_paid);
      formData.append("rounded", this.rounded);
      formData.append("invoice", this.formData.invoice);
      formData.append("accountNumber", this.formData.accountNumber);
      formData.append("amount", this.formData.amount);
      formData.append("proofofpayment", this.formData.proofofpayment);

      let delay = 2000;
      setTimeout(() => {
        axios
          .post("/lapmsv1/api/store/tenant/payment", formData)
          .then((response) => {
            if (response.status === 200) {
              toastr.success(
                "Tenant successfully Saved in the Database!",
                "Success",
                {
                  timeOut: 10000,
                  closeButton: true,
                }
              );
              $("#modalForumTopic").modal("hide");
              window.location.href = "/lapmsv1/view/tenant/payment/" + this.id;
              setTimeout(() => {
                location.reload();
              }, 1000); // Example: Reload after 1 second
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
              toastr.error("Property name already exist", "Error", {
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

    updateTenant() {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("tenantname", this.tenantname);
      formData.append("tenantno", this.tenantno);
      formData.append("id", this.id);
      formData.append("propertyid", this.propertyid);
      formData.append("paymentmode", this.formData.paymentmode);
      formData.append("date_paid", this.formData.date_paid);
      formData.append("invoice", this.formData.invoice);
      formData.append("accountNumber", this.formData.accountNumber);
      formData.append("amount", this.formData.amount);
      formData.append("proofofpayment", this.formData.proofofpayment);
      let delay = 2000;

      setTimeout(() => {
        axios
          .post("/lapmsv1/api/update/tenant/payment/" + this.formData.id, formData)
          .then((response) => {
            if (response.status === 200) {
              toastr.success(
                "Tenant successfully updated in the Database!",
                "Success",
                {
                  timeOut: 10000,
                  closeButton: true,
                }
              );
              window.location.href = "/lapmsv1/view/tenant/payment/" + this.id;
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

    handlePaymentModeChange() {
      // Handle additional logic when the payment mode changes
      // For example, you can clear the account number field if needed
      if (this.formData.paymentmode === "Cash") {
        this.formData.accountNumber = "";
      }
    },
    openModal(mode, tenant) {
      // Reset the form data
      this.formData = {
        id: "",
        paymentmode: "",
        accountNumber: "",
        amount: "",
        date_paid: "",
        proofofpayment: null,
      };

      // Set the modal mode
      this.modalMode = mode;

      // Set the modal title based on the mode
      this.modalTitle =
        mode === "add"
          ? "Add New Tenant"
          : mode === "edit"
            ? "Edit Tenant"
            : "View Tenant";

      if (mode === "edit") {
        // Populate formData with property data for editing
        this.formData.id = tenant.id;
        this.formData.paymentmode = tenant.mode_of_payment;
        this.formData.accountNumber = tenant.acctno;
        this.formData.amount = tenant.amount;
        this.formData.date_paid = tenant.date_paid;




        // Populate other formData properties based on your property object
      }

      // Set the view mode flag
      // this.viewMode = mode === "edit";

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
    getLogo() {
      return "/lapmsv1/public/images/logo.png";
    },
    getCurrentDate() {
      const today = new Date();
      const options = { year: "numeric", month: "long", day: "numeric" };
      return today.toLocaleDateString("en-US", options);
    },
    formatDate(dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      const formattedDate = new Date(dateString).toLocaleDateString(
        "en-US",
        options
      );
      return formattedDate;
    },
  },
  data() {
    return {
      currentPage: 1,
      itemsPerPage: 15,
      selectedMode: 'All',
      searchQuery: '',
      viewMode: "",
      errors: {},
      isLoading: false,
      modalMode: "add", // 'add' or 'edit'
      modalTitle: "Add New Property", // Default title for the modal

      formData: {
        id: "",
        paymentmode: "", // Set a default value
        accountNumber: "",
        date_paid: "",
        proofofpayment: null, // File input for furnishings
      },
      currentDate: this.getCurrentDate(),
    };
  },
  computed: {
    sortedPayments() {
    return this.paginatedPayments.slice().sort((a, b) => new Date(b.date_paid) - new Date(a.date_paid));
  },
    totalPages() {
      return Math.ceil(this.filteredPayment.length / this.itemsPerPage);
    },
    paginatedPayments() {
      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;

      return this.filteredPayment.slice(startIndex, endIndex);
    },
    filteredPayment() {
      return this.payment.filter(paymentItem => {
        // Check if paymentItem is not null or undefined
        if (!paymentItem) {
          return false;
        }

        const matchesSearch = (
          (paymentItem.invoice && paymentItem.invoice.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
          (paymentItem.date_paid && paymentItem.date_paid.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
          (paymentItem.mode_of_payment && paymentItem.mode_of_payment.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
          (paymentItem.acctno && paymentItem.acctno.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
          (paymentItem.amount && paymentItem.amount.toString().includes(this.searchQuery.toLowerCase())) ||
          (paymentItem.status && paymentItem.status.toLowerCase().includes(this.searchQuery.toLowerCase()))
        );

        const matchesCash = (
          (this.selectedMode === 'Cash' && paymentItem.mode_of_payment && paymentItem.mode_of_payment.toLowerCase() === 'Cash') ||
          (this.selectedMode === 'G-cash' && paymentItem.mode_of_payment && paymentItem.mode_of_payment.toLowerCase() === 'G-Cash')
        );

        const matchesMode = !this.selectedMode || this.selectedMode === 'All' || matchesCash || (paymentItem.mode_of_payment && paymentItem.mode_of_payment === this.selectedMode);

        return matchesSearch && matchesMode;
      });


    },


    // Calculate the grand total by summing up the amounts
    grandTotal() {
      return this.payment.reduce(
        (total, paymentItem) => total + parseFloat(paymentItem.amount),
        0
      );
    },
  },
  created() { 
    
  },
  mounted() {
    console.log("Component Mounted");
  },
};
</script>

<style scoped>
  .highlight-row {
    background-color: yellow; /* Set your desired highlight color */
    font-weight: bold; /* Optional: Make the text bold */
  }
</style>
