<template>
  <div>
    <div class="pageheader pd-t-25 pd-b-35">
      <div class="d-flex justify-content-between">
        <div class="clearfix">
          <div class="pd-t-5 pd-b-5">
            <h1 class="pd-0 mg-0 tx-20 tx-dark">
              <i class="fa fa-credit-card"></i>
              <!-- Assuming 'fa-building' is the Font Awesome class for a building icon -->
              Payment List
            </h1>
          </div>
          <div class="breadcrumb pd-0 mg-0">
            <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Dashboard</a>
            <a class="breadcrumb-item" href="">Payment</a>
            <span class="breadcrumb-item active">Real State</span>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-xs">
      <div class="col-sm-3">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <i class="fa fa-money-bill"></i>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Over All Income</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter"></span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span> -->
              <span class="float-right">
                <i class="ion-android-arrow-up mr-1 tx-success"></i><span class="tx-dark">{{
                  formatCurrency(counts.totalAmount)
                }}</span>
                <!-- <span class="small mg-b-0">/100</span> -->
              </span>
            </div>
            <div class="progress ht-3">
              <div class="progress-bar bg-primary wd-90p" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <i class="fa fa-dollar-sign"></i>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Daily Income</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter"></span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span> -->
              <span class="float-right">
                <i class="ion-android-arrow-up mr-1 tx-success"></i><span class="tx-dark">{{
                  formatCurrency(counts.totalAmountDaily)
                }}</span>
              </span>
            </div>
            <div class="progress ht-3">
              <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <i class="fa fa-money-bill"></i>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Monthly Income</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter"></span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span> -->
              <span class="float-right">
                <i class="ion-android-arrow-down mr-1 tx-danger"></i><span class="tx-dark">{{
                  formatCurrency(counts.totalAmountMonthly)
                }}</span>
              </span>
            </div>
            <div class="progress ht-3">
              <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <i class="fa fa-dollar-sign"></i>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">YEARLY INCOME - {{ getCurrentYear()
                }}</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter"></span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-lef tx-11 tx-gray-500">Achievement</span> -->
              <span class="float-right">
                <i class="ion-android-arrow-down mr-1 tx-success"></i><span class="tx-dark">{{
                  formatCurrency(counts.totalAmountYearly)
                }}</span>
              </span>
            </div>
            <div class="progress ht-3">
              <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-danger position-relative notification-button">
      <i :class="[
            'fa',
            'fa-bell',
            { 'animated-bell': duedatescount.overdueCount > 0 },
          ]"></i>
      Notification:
      {{
        duedatescount.overdueCount > 0
        ? `${duedatescount.overdueCount} Tenant${duedatescount.overdueCount !== 1 ? "s" : ""
        } Due ${duedatescount.overdueCount !== 1 ? "" : ""} today`
        : "No Tenant Due Today"
      }}
    </button>

    <button type="button" class="btn btn-info" id="dateButton">
      <i class="fa fa-calendar"></i> Date Today: <span id="currentDate">{{ currentDate }}</span>
    </button>

    <br />
    <br />

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
            <input class="input form-control" type="text" v-model="tableData.search" placeholder="Search Tenant"
              @input="getData()" />
          </div>
        </div>
        <br /><br /><br />
        <div class="table-responsive">
          <datatable v-if="data.length > 0" :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
              <tr class="odd gradeX" v-for="(data, index) in data" :key="data.id">
                <td>{{ index + 1 }}</td>
                <td>{{ data.tenant_name }}</td>
                <td>{{ data.contact_number }}</td>
                <td>{{ formatNumberWithCommas(data.rate) }}</td>
                <td>{{ data.period }} Months</td>
                <td>{{ formatDate(data.duedate) }}</td>
                <td>
                  {{ data.paymenttenants_count }}
                  {{
                    data.paymenttenants_count === 1 ? "Month" : "Months"
                  }}
                  Paid
                </td>

                <td>
                  <span class="badge badge-outline-success">{{
                    data.status
                  }}</span>
                </td>

                <td class="tx-center">
                  <a v-bind:href="'/lapmsv1/view/tenant/payment/' + data.id" class="btn btn-success" title="View"
                    data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-eye"> Summary</i>
                  </a>
                  <a v-bind:href="'/lapmsv1/print/payment/' + data.id" target="_balnk" class="btn btn-danger">
                    <i class="fa fa-print"></i> Print
                  </a>
                </td>
              </tr>
            </tbody>
          </datatable>
          <div v-else>
            <center>
              <img :src="getImageUrl1()" alt="No Data Found" style="width: 300px" />
            </center>
          </div>

          <pagination :pagination="pagination" @prev="getData(pagination.prevPageUrl)"
            @next="getData(pagination.nextPageUrl)">
          </pagination>
          <br />
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
    totalAmount() {
      axios
        .get("/lapmsv1/api/total/amount")
        .then((response) => {
          this.counts = response.data;
        })
        .catch((error) => {
          toastr.error("Error fetching Overaall Income.", "Error", {
            timeOut: 5000,
            closeButton: true,
          });
          console.error("Error fetching Over all Income", error);
        });
    },
    getDuedateNotif() {
      axios
        .get("/lapmsv1/api/count/due/date")
        .then((response) => {
          this.duedatescount = response.data;
        })
        .catch((error) => {
          toastr.error("Error fetching Overaall Income.", "Error", {
            timeOut: 5000,
            closeButton: true,
          });
          console.error("Error fetching Over all Income", error);
        });
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
          text: "You will not be able to recover this Tenant!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        });

        // If the user confirms
        if (result.isConfirmed) {
          // Make the Axios POST request to delete the property
          const response = await axios.post(`/lapmsv1/api/delete/tenant/${id}`);

          // Handle success response as needed
          console.log(response.data);

          // Optionally, you can reload or update your component data after deletion
          // this.$emit('propertyDeleted', id);

          // Inform the user about the successful deletion
          Swal.fire({
            title: "Deleted!",
            text: "Your property has been deleted.",
            icon: "success",
          }).then(() => {
            // Redirect to the desired URL after the user clicks "OK"
            window.location.href = "/lapmsv1/tenant";
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

    handleFileChange(fileType) {
      // Update formData with the selected file
      this.formData[fileType] = event.target.files[0];
    },
    submitForm() {
      // Handle form submission based on the mode (add or edit)
      if (this.modalMode === "add") {
        // Add logic for creating a new property
        this.storeTenant(
          "/lapmsv1/api/store/tenant",
          "Property successfully saved in the Database!"
        );
      } else {
        // Add logic for updating an existing property
        this.updateTenant(
          "/lapmsv1/api/update/tenant",
          "Property successfully updated in the Database!"
        );
      }
    },

    openModal(mode, tenant) {
      // Reset the form data
      this.formData = {
        id: "",
        selectedProperty: "",
        tenant_name: "",
        contact_no: "",
        address: "",
        monthly_rate: "",
        lease_period: "",
        due_date: "",
        contracts: null,
        id1: null,
        id2: null,

        // Reset other form fields as needed
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

      if (mode === "edit" || mode === "view") {
        // Populate formData with property data for editing
        this.formData.id = tenant.id;
        this.formData.selectedProperty = tenant.property_id;
        this.formData.tenant_name = tenant.tenant_name;
        this.formData.contact_no = tenant.contact_number;
        this.formData.address = tenant.address;
        this.formData.monthly_rate = tenant.rate;
        this.formData.lease_period = tenant.period;
        this.formData.due_date = tenant.duedate;
        this.formData.contracts = tenant.contracts;
        this.formData.id1 = tenant.id1;
        this.formData.id2 = tenant.id2;

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

    updateTenant(id) {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("tenant_name", this.formData.tenant_name);
      formData.append("contact_no", this.formData.contact_no);
      formData.append("address", this.formData.address);
      formData.append("monthly_rate", this.formData.monthly_rate);
      formData.append("lease_period", this.formData.lease_period);
      formData.append("due_date", this.formData.due_date);
      formData.append("contracts", this.formData.contracts);
      formData.append("id1", this.formData.id1);
      formData.append("id2", this.formData.id2);

      let delay = 2000;

      setTimeout(() => {
        axios
          .post("/lapmsv1/api/update/tenant/" + this.formData.id, formData)
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
              window.location.href = "/lapmsv1/tenant";
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
    getData(url = "/lapmsv1/api/get/data/tenant") {
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

    storeTenant() {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("selectedProperty", this.formData.selectedProperty);
      formData.append("tenant_name", this.formData.tenant_name);
      formData.append("contact_no", this.formData.contact_no);
      formData.append("address", this.formData.address);
      formData.append("monthly_rate", this.formData.monthly_rate);
      formData.append("lease_period", this.formData.lease_period);
      formData.append("due_date", this.formData.due_date);
      formData.append("contracts", this.formData.contracts);
      formData.append("id1", this.formData.id1);
      formData.append("id2", this.formData.id2);

      let delay = 2000;
      setTimeout(() => {
        axios
          .post("/lapmsv1/api/store/tenant", formData)
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
              window.location.href = "/lapmsv1/tenant";
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
      duedatescount: "",
      selectedProperty: "",
      properties: [],
      property: [],
      viewMode: "",
      counts: {},
      modalMode: "add", // 'add' or 'edit'
      modalTitle: "Add New Property", // Default title for the modal

      formData: {
        selectedProperty: "",
        tenant_name: "",
        contact_no: "",
        address: "",
        monthly_rate: "",
        lease_period: "",
        due_date: "",
        contracts: null,
        id1: null, // File input for furnishings
        id2: null, // File input for image1
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
    this.updateCurrentDate();

    // Optionally, you can set up an interval to update the date every minute
    setInterval(this.updateCurrentDate, 60000);
    this.totalAmount();
    this.getDuedateNotif();
    // this.getProperty();
    // this.getTenantCounts();
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

