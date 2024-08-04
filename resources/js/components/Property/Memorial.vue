<template>
  <div>
    <div class="pageheader pd-t-25 pd-b-35">
      <div class="d-flex justify-content-between">
        <div class="clearfix">
          <div class="pd-t-5 pd-b-5">
            <h1 class="pd-0 mg-0 tx-20 tx-dark">
              <i class="fa fa-building"></i>
              <!-- Assuming 'fa-building' is the Font Awesome class for a building icon -->
              Memorial List
            </h1>
          </div>
          <div class="breadcrumb pd-0 mg-0">
            <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Dashboard</a>
            <a class="breadcrumb-item" href="">Real State</a>
            <span class="breadcrumb-item active">Memorial</span>
          </div>
        </div>
        <div class="d-flex align-items-center hidden-xs">
          <button @click="openModal('add')" data-toggle="modal" class="btn btn-primary">
            <span data-feather="plus" class="wd-16 mr-2"></span>Create Memorial
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
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Over All Memorial</span>
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
              <div class="progress-bar bg-primary wd-90p" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">SOLD MEMORIAL</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter">{{ counts.occupiedMemorial }}</span>
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
              <div class="progress-bar bg-warning wd-95p" role="progressbar" aria-valuenow="95" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Available Memorial</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter">{{ counts.availableMemorial }}</span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span>
              <span class="float-right">
                <i class="ion-android-arrow-down mr-1 tx-danger"></i><span class="tx-dark">81</span><span
                  class="small mg-b-0">/100</span>
              </span> -->
            </div>
            <div class="progress ht-3">
              <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-sm-3">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Total Income</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter">{{
                    formatCurrency(counts.totalAmount)
                  }}</span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <span class="float-left tx-11 tx-gray-500">Achievement</span>
              <span class="float-right">
                <i class="ion-android-arrow-down mr-1 tx-danger"></i><span class="tx-dark">81</span><span
                  class="small mg-b-0">/100</span>
              </span>
            </div>
            <div class="progress ht-3">
              <div class="progress-bar bg-danger wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div> -->

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
          <datatable v-if="data.length > 0" :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
              <tr class="odd gradeX" v-for="(data, index) in data" :key="data.id">
                <td>{{ index + 1 }}</td>
                <td>{{ data.memorial_name }}</td>
                <td>{{ data.memorial_address }}</td>
                <td>{{ formatNumberWithCommas(data.sq_meter) }} SQ. Meter</td>
                <td>{{ formatCurrency(data.amount) }}</td>
                <td><span class="badge badge-outline-success">{{ data.status }}</span> </td>
                <td>
                  <template v-if="data.rentedidle === 'Available'">
                    <span class="badge badge-outline-success">{{ data.rentedidle }}</span>
                  </template>
                  <template v-if="data.rentedidle === 'Sold'">
                    <span class="badge badge-outline-danger">{{ data.rentedidle }}</span>
                  </template>

                </td>
                <td style="text-align: center">
                  <a v-bind:href="'/lapmsv1/public/memorial/documents/' +
                    data.memorial_no +
                    '/' +
                    data.documents
                    " target="_blank">
                    <i class="fa fa-file-pdf-o" style="color: red; font-size: 24px"></i>
                  </a>

                  <a v-bind:href="'/lapmsv1/public/memorial/documents/' +
                    data.memorial_no +
                    '/' +
                    data.image
                    " target="_blank">
                    <i class="fa fa-image" style="color: blue; font-size: 24px"></i>
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
                  <button @click="openModal('edit', data)" class="btn btn-info" title="Edit" data-toggle="tooltip"
                    data-placement="top">
                    <i class="fa fa-pencil"> Edit/View</i>
                  </button>
                  <template v-if="data.rentedidle === 'Available'">
                    <button @click="confirmDelete(data.id)" class="btn btn-danger" title="Remove" data-toggle="tooltip"
                      data-placement="top">
                      <i class="fa fa-trash"> Delete</i>
                    </button>
                  </template>
                  <template v-if="data.rentedidle === 'Sold'">
                    <button @click="noDelete(data.id)" class="btn btn-danger" title="Remove" data-toggle="tooltip"
                      data-placement="top">
                      <i class="fa fa-trash"> Delete</i>
                    </button>
                  </template>
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
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                    <i data-feather="x"></i>
                  </button>
                </div>
                <div class="modal-body">
                  <form @submit.prevent="submitForm">
                    <div class="row">
                      <template v-if="modalMode === 'add'">


                      </template>
                    </div>
                    <h6>
                      <label>
                        <i class="fa fa-building"></i> Memorial Details</label>
                    </h6>
                    <div class="row">
                      <div class="col-md-12">
                        <label>Date Created:</label>
                        <input type="date" class="form-control" v-model="formData.date_created" /><br />

                      </div>
                      <div class="col-md-6">
                        <label>Memorial Name:</label>
                        <input type="text" class="form-control" v-model="formData.memorial_name"
                          placeholder="Enter Memorial Name" /><br>
                      </div>

                      <div class="col-md-6">
                        <label>Sq Meter:</label>
                        <input type="text" class="form-control" v-model="formData.sq_meter"
                          placeholder="Enter Sq Meter" /><br>
                      </div>

                      <div class="col-md-12">
                        <label>Address/Location of Memorial:</label>
                        <textarea id="w3review" v-model="formData.memorial_address" class="form-control" rows="4"
                          cols="50" placeholder="Enter Address/Location of Memorial">
                        </textarea><br />
                      </div>
                      <div class="col-md-12">
                        <label>Memorial Amount</label>
                        <input type="number" v-model="formData.amount" class="form-control"
                          placeholder="Enter Price of Memorial" /><br>
                      </div>
                    </div>

                    <template v-if="modalMode === 'add' || modalMode === 'edit'">
                      <h6>
                        <label>
                          <i class="fa fa-folder"></i>
                          Documents/Attachment</label>
                      </h6>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Documents</label>
                          <input type="file" class="form-control" @change="handleFileChange('documents')" /><br />
                        </div>
                        <div class="col-md-6">
                          <label>Image of Memorial</label>
                          <input type="file" class="form-control" @change="handleFileChange('image')" /><br />
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
                      Memorial
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
    noDelete() {
      Swal.fire({
        title: "Error!",
        text: "Unable to delete. This Memorial is already Sold.",
        icon: "error",
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
          const response = await axios.post(`/lapmsv1/api/delete/memorial/${id}`);

          // Handle success response as needed
          console.log(response.data);

          // Optionally, you can reload or update your component data after deletion
          // this.$emit('propertyDeleted', id);

          // Inform the user about the successful deletion
          Swal.fire({
            title: "Deleted!",
            text: "Memorial has been deleted.",
            icon: "success",
          }).then(() => {
            // Redirect to the desired URL after the user clicks "OK"
            window.location.href = "/lapmsv1/memorial";
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
    getMemorialCounts() {
      axios
        .get("/lapmsv1/api/count/memorial")
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
        this.storeMemorial(
          "/lapmsv1/api/store/memorial",
          "Property successfully saved in the Database!"
        );
      } else {
        // Add logic for updating an existing property
        this.updateMemorial(
          "/lapmsv1/api/update/memorial",
          "Property successfully updated in the Database!"
        );
      }
    },

    openModal(mode, memorial) {
      // Reset the form data
      this.formData = {
        id: "",
        date_created: "",
        memorial_name: "",
        memorial_no: "",
        sq_meter: "",
        memorial_address: "",
        amount: "",
        documents: null,
        image: null,


        // Reset other form fields as needed
      };

      // Set the modal mode
      this.modalMode = mode;

      // Set the modal title based on the mode
      this.modalTitle =
        mode === "add"
          ? "Create New Memorial"
          : mode === "edit"
            ? "Edit Memorial"
            : "View Tenant";

      if (mode === "edit" || mode === "view") {
        // Populate formData with property data for editing
        this.formData.id = memorial.id;
        this.formData.memorial_no = memorial.memorial_no;
        this.formData.memorial_name = memorial.memorial_name;
        this.formData.memorial_address = memorial.memorial_address;
        this.formData.sq_meter = memorial.sq_meter;
        this.formData.date_created = memorial.date_created;
        this.formData.amount = memorial.amount;
        this.formData.documents = memorial.documents;
        this.formData.image = memorial.image;

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

    getData(url = "/lapmsv1/api/get/data/memorial") {
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

    storeMemorial() {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("date_created", this.formData.date_created);
      formData.append("memorial_name", this.formData.memorial_name);
      formData.append("sq_meter", this.formData.sq_meter);
      formData.append("memorial_address", this.formData.memorial_address);
      formData.append("amount", this.formData.amount);
      formData.append("documents", this.formData.documents);
      formData.append("image", this.formData.image);
      let delay = 2000;
      setTimeout(() => {
        axios
          .post("/lapmsv1/api/store/memorial", formData)
          .then((response) => {
            if (response.status === 200) {
              toastr.success(
                "Memorial successfully Saved in the Database!",
                "Success",
                {
                  timeOut: 10000,
                  closeButton: true,
                }
              );
              window.location.href = "/lapmsv1/memorial";
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
    updateMemorial() {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("memorial_no", this.formData.memorial_no);
      formData.append("date_created", this.formData.date_created);
      formData.append("memorial_name", this.formData.memorial_name);
      formData.append("sq_meter", this.formData.sq_meter);
      formData.append("memorial_address", this.formData.memorial_address);
      formData.append("amount", this.formData.amount);
      formData.append("documents", this.formData.documents);
      formData.append("image", this.formData.image);
      let delay = 2000;
      setTimeout(() => {
        axios
          .post("/lapmsv1/api/update/memorial/" + this.formData.id, formData)
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
              window.location.href = "/lapmsv1/memorial";
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
      { width: "10%", label: "Memorial Name", name: "memorial_name" },
      { width: "15%", label: "Address", name: "memorial_address" },
      { width: "10%", label: "SQ Meter.", name: "sq_meter" },
      { width: "5%", label: "Amount", name: "amount" },
      { width: "5%", label: "Property Type", name: "status" },
      { width: "5%", label: "Sale IDLE", name: "rentedidle" },
      { width: "5%", label: "Attachment", name: "attachment" },
      { width: "12%", label: "Action", name: "action" },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {

      selectedProperty: "",
      properties: [],
      property: [],
      viewMode: "",
      counts: {},
      modalMode: "add", // 'add' or 'edit'
      modalTitle: "Add New Property", // Default title for the modal

      formData: {
        id: "",
        selectedProperty: "",
        tenant_name: "",
        memorial_no: "",
        contact_no: "",
        tenant_no: "",
        address: "",
        date_created: "",
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

    this.getMemorialCounts();
    console.log("Component Mounted");
  },
};
</script>
