<template>
  <div>
    <div class="pageheader pd-t-25 pd-b-35">
      <div class="d-flex justify-content-between">
        <div class="clearfix">
          <div class="pd-t-5 pd-b-5">
            <h1 class="pd-0 mg-0 tx-20 tx-dark">
              <i class="fa fa-building"></i>
              <!-- Assuming 'fa-building' is the Font Awesome class for a building icon -->
              Property List
            </h1>
          </div>
          <div class="breadcrumb pd-0 mg-0">
            <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Dashboard</a>
            <a class="breadcrumb-item" href="">Real State</a>
            <span class="breadcrumb-item active">Property</span>
          </div>
        </div>
        <div class="d-flex align-items-center hidden-xs">
          <button @click="openModal('add')" data-toggle="modal" class="btn btn-primary">
            <span data-feather="plus" class="wd-16 mr-2"></span>Create Property
          </button>
        </div>
        <!-- 
      
          <button @click="openModal('add')" data-toggle="modal" class="btn btn-primary">
            <span data-feather="plus" class="wd-16 mr-2"></span>Create Property 1
          </button> -->

      </div>
    </div>

    <div></div>

    <div class="row row-xs">
      <div class="col-sm-4">
        <div class="card mg-b-30">
          <div class="card-body">
            <div class="media d-inline-flex">
              <div>
                <i class="fa fa-building"></i>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">
                  Over All Property

                </span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter">{{ counts.overallCount }}</span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span> -->

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
                <i class="fa fa-check-circle"></i>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">
                  Available Property

                </span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter">{{ counts.availableCount }}</span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span> -->

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
                <i class="fa fa-times-circle"></i>
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Occupied Property</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter">{{ counts.occupiedCount }}</span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <!-- <span class="float-left tx-11 tx-gray-500">Achievement</span> -->

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
                <span class="tx-uppercase tx-spacing-1 tx-semibold tx-10 mg-b-2">Tenant Availed Property</span>
                <h2 class="tx-20 tx-sm-18 tx-md-24 mb-0 mt-2 mt-sm-0 tx-normal tx-rubik tx-dark">
                  <span class="counter">1,250</span>
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <span class="float-lef tx-11 tx-gray-500">Achievement</span>
              <span class="float-right">
                <i class="ion-android-arrow-down mr-1 tx-success"></i><span class="tx-dark">85</span><span
                  class="small mg-b-0">/100</span>
              </span>
            </div>
            <div class="progress ht-3">
              <div class="progress-bar bg-teal wd-85p" role="progressbar" aria-valuenow="85" aria-valuemin="0"
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
          <datatable v-if="data.length > 0" :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders"
            @sort="sortBy">
            <tbody>
              <tr class="odd gradeX" v-for="data in data" :key="data.id">
                <td>{{ data.property_no }}</td>
                <td>{{ data.property_name }}</td>
                <td>{{ data.complete_address }}</td>
                <td>{{ formatNumberWithCommas(data.monthlyrate) }}</td>
                <td>{{ data.type }}</td>
                <td>
                  <template v-if="data.status === 'Occupied'">
                    <span class="badge badge-outline-danger">{{
                      data.status
                    }}</span>
                  </template>
                  <template v-if="data.status === 'Available'">
                    <span class="badge badge-outline-success">{{
                      data.status
                    }}</span>
                  </template>

                </td>


                <td class="tx-center">
                  <!-- <button @click="openModal('view', data)" class="btn btn-success" title="View" data-toggle="tooltip"
                    data-placement="top">
                    <i class="fa fa-eye"> View</i>
                  </button> -->
                  <button @click="openModal('edit', data)" class="btn btn-info" title="Edit" data-toggle="tooltip"
                    data-placement="top">
                    <i class="fa fa-pencil"> View/Edit</i>
                  </button>
                  <template v-if="data.status === 'Available'">
                    <button @click="confirmDelete(data.id)" class="btn btn-danger" title="Remove" data-toggle="tooltip"
                      data-placement="top">
                      <i class="fa fa-trash"> Delete</i>
                    </button>
                  </template>
                  <template v-if="data.status === 'Occupied'">
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
                  <h5 class="modal-title">{{ modalTitle }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                    <i data-feather="x"></i>
                  </button>
                </div>
                <div class="modal-body pd-y-20">
                  <!-- Form for creating or updating a property -->
                  <div v-if="modalMode === 'view'">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Property Image</label>
                        <img :src="getImageUrl(formData.image1)" alt="Property Image" class="img-fluid" />
                      </div>
                      <div class="col-md-6">
                        <label>Property Name:</label>
                        <input type="text" class="form-control" v-model="formData.propertyname"
                          placeholder="Enter Property Name" /><br />
                        <label>Property Address:</label>
                        <textarea id="w3review" v-model="formData.completeaddress" class="form-control" rows="4"
                          cols="50" placeholder="Enter Address of Property">
              </textarea><br />
                        <label>Description of Property:</label>
                        <textarea id="w3review" v-model="formData.description" class="form-control" rows="4" cols="50"
                          placeholder="Enter Address of Property">
              </textarea><br />
                        <div class="row">
                          <div class="col-md-12">
                            <label>Bedrooms</label>
                            <input type="text" class="form-control" v-model="formData.bed_rooms" /><br />
                            <label>S.Q M</label>
                            <input type="text" class="form-control" v-model="formData.sq_meter" /><br />
                            <label>Car Park</label>
                            <input type="text" class="form-control" v-model="formData.carpark" /><br />
                            <label>Bedrooms</label>
                            <input type="text" class="form-control" v-model="formData.bed_rooms" /><br />
                            <label>S.Q M</label>
                            <input type="text" class="form-control" v-model="formData.sq_meter" /><br />
                            <label>Car Park</label>
                            <input type="text" class="form-control" v-model="formData.carpark" /><br />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-if="modalMode === 'edit' || modalMode === 'add'">
                    <form @submit.prevent="submitForm">
                      <!-- Form fields for property details -->
                      <div class="row">
                        <div class="col-md-12">
                          <!-- <input type="text" class="form-control" v-model="formData.property_no"
                                                    placeholder="Enter Property Name"> -->
                          <div>
                            <label><span class="tx-danger">*</span>Property Type:</label>
                            <div>
                              <input type="radio" id="forSale" value="For Sale" v-model="formData.selectedPropertyType">
                              <label for="forSale">For Sale</label>
                            </div>
                            <div>
                              <input type="radio" id="forRent" value="For Rent" v-model="formData.selectedPropertyType">
                              <label for="forRent">For Rent</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <!-- <input type="text" class="form-control" v-model="formData.property_no"
                                                    placeholder="Enter Property Name"> -->
                          <label><span class="tx-danger">*</span>Title:</label>
                          <input type="text" class="form-control" v-model="formData.propertyname"
                            placeholder="Enter Property Name" /><br />
                        </div>
                        <div class="col-md-12">
                          <label><span class="tx-danger">*</span>Address of the
                            Property:</label>
                          <textarea id="w3review" v-model="formData.completeaddress" class="form-control" rows="4"
                            cols="50" placeholder="Enter Address of Property">
                </textarea><br />
                        </div>
                        <div class="col-md-12">
                          <label><span class="tx-danger">*</span>Description of the
                            Property:</label>
                          <textarea id="w3review" v-model="formData.description" class="form-control" rows="4" cols="50"
                            placeholder="Enter Description of Property">
                </textarea><br />
                        </div>

                        <div class="col-md-4">
                          <label class="form-control-label"><span class="tx-danger">*</span>Bedrooms:</label>
                          <input type="number" class="form-control" v-model="formData.bed_rooms"
                            placeholder="Enter No. of Bedrooms" /><br />
                        </div>
                        <div class="col-md-4">
                          <label class="form-control-label"><span class="tx-danger">*</span>S.Q Meter:</label>
                          <input type="number" class="form-control" v-model="formData.sq_meter"
                            placeholder="Enter Sq. meter" /><br />
                        </div>
                        <div class="col-md-4">
                          <label class="form-control-label"><span class="tx-danger">*</span>Car Park:</label>
                          <input type="number" class="form-control" v-model="formData.carpark"
                            placeholder="Enter No. of Car Park" /><br />
                        </div>

                        <div class="col-md-4">
                          <label class="form-control-label"><span class="tx-danger">*</span>Toilet:</label>
                          <input type="number" class="form-control" v-model="formData.toilets"
                            placeholder="Enter No. of Toilet" /><br />
                        </div>
                        <div class="col-md-4">
                          <label class="form-control-label"><span class="tx-danger">*</span>Bathroom:</label>
                          <input type="number" class="form-control" v-model="formData.bathroom"
                            placeholder="Enter No. of Car Park" /><br />
                        </div>
                        <div class="col-md-4">
                          <label class="form-control-label"><span class="tx-danger">*</span>
                            Rate of Property:</label>
                          <input type="number" class="form-control" v-model="formData.mothlyrate"
                            placeholder="Enter Rate of Property" /><br />
                        </div>



                      </div>
                      <div class="row">

                        <div class="col-md-12">
                          <label class="form-control-label"><span class="tx-danger">*</span>Image of
                            Property:</label>
                          <input type="file" class="form-control" @change="handleFileChange('image1')" />
                          <span style="color: red">
                            Upload Image of property (.png and jpeg
                            format)</span><br />
                        </div>


                        <div class="col-md-12">
                          <label class="form-control-label"><span class="tx-danger">*</span>Image of
                            Property:</label>
                          <input type="file" class="form-control" @change="handleFileChange('image2')" />
                          <span style="color: red">
                            Upload Image of property (.png and jpeg
                            format)</span><br />
                        </div>

                        <div class="col-md-12">
                          <label class="form-control-label"><span class="tx-danger">*</span>Image of
                            Property:</label>
                          <input type="file" class="form-control" @change="handleFileChange('image3')" />
                          <span style="color: red">
                            Upload Image of property (.png and jpeg
                            format)</span><br />
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
                      <i class="fa fa-check"></i>
                      {{ modalMode === "add" ? "Create" : "Update" }}
                      Property
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
    getImageUrl1() {
      return "/property_prime/public/images/nodatafound.png";
    },

    noDelete() {
      Swal.fire({
        title: "Error!",
        text: "Unable to delete. This property is already rented.",
        icon: "error",
      });


    },
    async confirmDelete(id, status) {


      try {

        // Display the confirmation dialog
        const result = await Swal.fire({
          title: "Are you sure?",
          text: "You will not be able to recover this property!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        });

        // If the user confirms
        if (result.isConfirmed) {
          // Make the Axios POST request to delete the property
          const response = await axios.post(
            `/property_prime/api/delete/property/${id}`
          );

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
            window.location.href = "/property_prime/property";
          });
        }
      }
      catch (error) {
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
        "/property_prime/public/property/furnishing/" +
        this.formData.propertyname +
        "/" +
        image
      );
    },
    getPropertyCounts() {
      axios
        .get("/property_prime/api/count/property")
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
        this.storeProperty(
          "/property_prime/api/store/property",
          "Property successfully saved in the Database!"
        );
      } else {
        // Add logic for updating an existing property
        this.updateProperty(
          "/property_prime/api/update/property",
          "Property successfully updated in the Database!"
        );
      }
    },

    openModal(mode, property) {
      // Reset the form data
      this.formData = {
        id: "",
        selectedPropertyType: "",
        date_created: "",
        property_no: "",
        propertyname: "",
        completeaddress: "",
        description: "",
        sq_meter: "",
        carpark: "",
        toilets: "",
        bathroom: "",
        sq_meter: "",
        mothlyrate: "",
        furnishings: null,
        image1: null,
        image2: null,
        image3: null,
        // Reset other form fields as needed
      };

      // Set the modal mode
      this.modalMode = mode;

      // Set the modal title based on the mode
      this.modalTitle =
        mode === "add"
          ? "Add New Property"
          : mode === "edit"
            ? "Edit Property"
            : "View Property";

      if (mode === "edit" || mode === "view") {
        // Populate formData with property data for editing
        this.formData.id = property.id;
        this.formData.selectedPropertyType = property.type;
        this.formData.date_created = property.date_created;
        this.formData.propertyname = property.property_name;
        this.formData.completeaddress = property.complete_address;
        this.formData.description = property.description;
        this.formData.bed_rooms = property.bedrooms;
        this.formData.sq_meter = property.sq;
        this.formData.carpark = property.carpark;
        this.formData.toilets = property.toilet;
        this.formData.bathroom = property.bath;
        this.formData.mothlyrate = property.monthlyrate;
        this.formData.property_no = property.property_no;
        this.formData.image1 = property.image1;
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

    updateProperty(id) {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("property_no", this.formData.property_no);
      formData.append("selectedPropertyType", this.formData.selectedPropertyType);
      formData.append("propertyname", this.formData.propertyname);
      formData.append("completeaddress", this.formData.completeaddress);
      formData.append("date_created", this.formData.date_created);
      formData.append("description", this.formData.description);
      formData.append("bed_rooms", this.formData.bed_rooms);
      formData.append("sq_meter", this.formData.sq_meter);
      formData.append("carpark", this.formData.carpark);
      formData.append("toilets", this.formData.toilets);
      formData.append("bathroom", this.formData.bathroom);
      formData.append("mothlyrate", this.formData.mothlyrate);
      formData.append("furnishings", this.formData.furnishings);
      formData.append("image1", this.formData.image1);
      formData.append("image2", this.formData.image2);
      formData.append("image3", this.formData.image3);

      let delay = 2000;

      setTimeout(() => {
        axios
          .post("/property_prime/api/update/property/" + this.formData.id, formData)
          .then((response) => {
            if (response.status === 200) {
              toastr.success(
                "Property successfully updated in the Database!",
                "Success",
                {
                  timeOut: 10000,
                  closeButton: true,
                }
              );
              window.location.href = "/property_prime/property";
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
    getData(url = "/property_prime/api/get/data/property") {
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

    storeProperty() {
      this.isLoading = true;
      const formData = new FormData();
      formData.append("propertyname", this.formData.propertyname);
      formData.append("completeaddress", this.formData.completeaddress);
      formData.append("description", this.formData.description);
      formData.append("bed_rooms", this.formData.bed_rooms);
      formData.append("sq_meter", this.formData.sq_meter);
      formData.append("carpark", this.formData.carpark);
      formData.append("toilets", this.formData.toilets);
      formData.append("bathroom", this.formData.bathroom);
      formData.append("mothlyrate", this.formData.mothlyrate);
      formData.append("selectedPropertyType", this.formData.selectedPropertyType);

      // Append images
      if (this.formData.image1) {
        formData.append("image1", this.formData.image1);
      }
      if (this.formData.image2) {
        formData.append("image2", this.formData.image2);
      }
      if (this.formData.image3) {
        formData.append("image3", this.formData.image3);
      }

      let delay = 2000;
      setTimeout(() => {
        axios
          .post("/property_prime/api/store/property", formData)
          .then((response) => {
            if (response.status === 200) {
              toastr.success(
                "Property successfully Saved in the Database!",
                "Success",
                {
                  timeOut: 10000,
                  closeButton: true,
                }
              );
              window.location.href = "/property_prime/property";
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
      { width: "0%", label: "Property #", name: "property_no" },
      { width: "20%", label: "Property Name", name: "property_name" },
      { width: "30%", label: "Address", name: "tenant_name" },
      { width: "15%", label: "Rate", name: "monthlyrate" },
      { width: "20%", label: "Type", name: "type" },
      { width: "8%", label: "Status", name: "status" },

      { width: "12%", label: "Action", name: "action" },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      viewMode: "",
      counts: {},
      modalMode: "add", // 'add' or 'edit'
      modalTitle: "Add New Property", // Default title for the modal
      formData: {
        property_no: "",
        propertyname: "",
        completeaddress: "",
        description: "",
        date_created: "",
        sq_meter: "",
        carpark: "",
        selectedPropertyType: "",
        toilets: "",
        bathroom: "",
        mothlyrate: "",
        sq_meter: "",
        furnishings: null, // File input for furnishings
        image1: null, // File input for image1
        image2: null, // File input for image1
        image3: null, // File input for image1
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
  created() {
    this.getData();
  },
  mounted() {
    this.getPropertyCounts();
    console.log("Component Mounted");
  },
};
</script>
