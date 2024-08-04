<template>
  <div>
    <div class="pageheader pd-t-25 pd-b-35">
      <div class="d-flex justify-content-between">
        <div class="clearfix">
          <div class="pd-t-5 pd-b-5">
            <h1 class="pd-0 mg-0 tx-20 tx-dark">Availed to Client</h1>
          </div>
          <div class="breadcrumb pd-0 mg-0">
            <a class="breadcrumb-item" href="index.html"
              ><i class="icon ion-ios-home-outline"></i> Home</a
            >
            <a class="breadcrumb-item" href="">Form</a>
            <span class="breadcrumb-item active">Form Element</span>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-xs clearfix">
      <div class="col-md-12 col-lg-12">
        <div class="card mg-b-30">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-header-title tx-13 mb-0">Basic Form</h6>
              </div>
              <div class="text-right">
                <div class="d-flex">
                  <a href="" class="mr-3"><i class="ti-reload"></i></a>
                  <div class="dropdown" data-toggle="dropdown">
                    <a href=""><i class="ti-more-alt"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a href="" class="dropdown-item"
                        ><i data-feather="info" class="wd-16 mr-2"></i>View
                        Details</a
                      >
                      <a href="" class="dropdown-item"
                        ><i data-feather="share" class="wd-16 mr-2"></i>Share</a
                      >
                      <a href="" class="dropdown-item"
                        ><i data-feather="download" class="wd-16 mr-2"></i
                        >Download</a
                      >
                      <a href="" class="dropdown-item"
                        ><i data-feather="copy" class="wd-16 mr-2"></i>Copy
                        to</a
                      >
                      <a href="" class="dropdown-item"
                        ><i data-feather="folder" class="wd-16 mr-2"></i>Move
                        to</a
                      >
                      <a href="" class="dropdown-item"
                        ><i data-feather="edit" class="wd-16 mr-2"></i>Rename</a
                      >
                      <a href="" class="dropdown-item"
                        ><i data-feather="trash" class="wd-16 mr-2"></i
                        >Delete</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            Memorial No: {{memorialno}}<br />
            Memorial Name: {{memorialname}}<br />
            Memorial Address: {{memorialaddress}}<br /><br />
            <div class="row">
              <div class="col-lg-12">
                <h6>Client Details</h6>
                <label>Name: </label>
                <input
                  class="form-control form-control-sm"
                  placeholder="Client Name"
                  type="text"
                /><br />
              </div>

              <div class="col-lg-12">
                <label>Address: </label>
                <textarea
                  rows="3"
                  class="form-control"
                  placeholder="Client Address"
                ></textarea
                ><br />
              </div>
              <div class="col-lg-12">
                <label>Contact Number: </label>
                <input
                  class="form-control form-control-sm"
                  placeholder="Contact Number"
                  type="number"
                /><br />
              </div>
              <div class="col-lg-12">
                <label>Payment: </label>
                <select class="form-control">
                  <option disabled>Select Payment</option>
                  <option>G-Cash</option>
                  <option>E-Payment</option>
                  <option>Cash</option>
                </select>
                <br />
              </div>
              <div class="col-lg-4">
                <label>Account Number: </label>
                <input
                  class="form-control form-control-sm"
                  placeholder="Account Number"
                  type="number"
                />
                <br />
              </div>
              <div class="col-lg-4">
                <label>Amount: </label>
                <input
                  class="form-control form-control-sm"
                  placeholder="Amount"
                  type="number"
                />
                <br />
              </div>
              <div class="col-lg-4">
                <label>Date Paid: </label>
                <input class="form-control form-control-sm" type="date" />
                <br />
              </div>

              <div class="col-lg-12">
                <label>Proof of Payment </label>
                <input class="form-control form-control-sm" type="file" />
                <br />
                <button type="button" class="btn btn-info">
                  <i class="fa fa-check">Submit</i>
                </button>
                <button type="button" class="btn btn-danger">
                  <i class="fa fa-arrow-back"></i>Back
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: {
    

    id: {
      type: Number,
      required: true,
    },
    memorialname: {
      type: String,
      required: true,
    },
     memorialno: {
      type: String,
      required: true,
    },
     memorialaddress: {
      type: String,
      required: true,
    },

    methods: {},
  },

  data() {
    return {};
  },

  created() {},
  mounted() {
    console.log("Component Mounted");
  },
};
</script>