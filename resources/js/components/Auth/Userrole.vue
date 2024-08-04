<template>
    <div class="page-inner">
        <div class="wrapper">
            <div class="pageheader pd-t-25 pd-b-35">
                <div class="d-flex justify-content-between">
                    <div class="clearfix">
                        <div class="pd-t-5 pd-b-5">
                            <h1 class="pd-0 mg-0 tx-20 tx-dark">User Role</h1>
                        </div>
                        <div class="breadcrumb pd-0 mg-0">
                            <a class="breadcrumb-item" href="index.html"><i class="icon ion-ios-home-outline"></i> Home</a>
                            <a class="breadcrumb-item" href="">User Role</a>

                        </div>
                    </div>
                    <div class="d-flex align-items-center hidden-xs">
                        <button @click="openModal('add')" data-toggle="modal" class="btn btn-primary">
                            <span data-feather="plus" class="wd-16 mr-2"></span>Create User Role
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mg-b-30">
            <div class="card-body">
                <div class="table-responsive">

                    <datatable v-if="data.length > 0" :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders"
                        @sort="sortBy">
                        <tbody>
                            <tr class="odd gradeX" v-for="(data, index) in data" :key="data.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ data.name }}</td>
                                <td>
                                    <div v-for="permission in permissions" :key="permission.id">
                                        <input type="checkbox" v-model="formData.selectedPermissions"
                                            :value="permission.id" />
                                        {{ permission.name }}
                                    </div>
                                </td>

                                <td>{{ data.created_at }}</td>
                                <td>Active</td>
                                <td> <button @click="openModal('edit', data)" class="btn btn-info" title="Edit"
                                        data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-pencil"> Edit</i>
                                    </button></td>
                            </tr>
                        </tbody>
                    </datatable>
                    <pagination :pagination="pagination" @prev="getData(pagination.prevPageUrl)"
                        @next="getData(pagination.nextPageUrl)">
                    </pagination>



                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ modalTitle }}</h5>
                                <button type="button" class="close" @click="closeModal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="submitForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Role Name:</label>
                                            <input type="text" v-model="formData.user_role" class="form-control"><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Permissions:</label>
                                            <div>
                                                <input type="checkbox" id="checkAll" v-model="checkAll"
                                                    @change="selectAllPermissions" />
                                                <label for="checkAll">Check all permissions</label>
                                            </div>


                                            <div v-for="permission in permissions" :key="permission.id">
                                                <input type="checkbox" v-model="formData.selectedPermissions"
                                                    :value="permission.id" />
                                                {{ permission.name }}
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" :disabled="isLoading"
                                    @click.prevent="submitForm">
                                    <span v-if="isLoading">
                                        <i class="fa fa-spinner"></i> Loading Please Wait
                                    </span>
                                    <span v-else>
                                        <i class="fa fa-check"></i>
                                        {{ modalMode === "add" ? "Submit" : "Update" }}
                                        User Role
                                    </span>
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

import toastr from "toastr";
import "toastr/build/toastr.css";
import Datatable from "..//Datatable.vue";
import Pagination from "..//Pagination.vue";
export default {
    components: { datatable: Datatable, pagination: Pagination },

    methods: {
        selectAllPermissions() {
            // Update the selectedPermissions based on checkAll
            this.formData.selectedPermissions = this.checkAll ? this.permissions.map(permission => permission.id) : [];
        },
        fetchPermissions() {
            axios.get('/lapmsv1/api/permissions') // Replace with your actual API endpoint
                .then(response => {
                    this.permissions = response.data.message;
                })
                .catch(error => {
                    console.error('Error fetching permissions', error);
                });
        },
        getData(url = "/lapmsv1/api/get/user") {
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
        submitForm() {
            // Handle form submission based on the mode (add or edit)
            if (this.modalMode === "add") {
                // Add logic for creating a new property
                this.storeRole(
                    "/lapmsv1/api/store/user/role",
                    "User Role successfully saved in the Database!"
                );
            } else {
                // Add logic for updating an existing property
                this.updateRole(
                    "/lapmsv1/api/update/user/role",
                    "User Role successfully updated in the Database!"
                );
            }
        },

        storeRole() {
            this.isLoading = true;
            const formData = new FormData();
            formData.append("user_role", this.formData.user_role);
            formData.append("selectedPermissions", this.formData.selectedPermissions);


            let delay = 2000;
            setTimeout(() => {
                axios
                    .post("/lapmsv1/api/store/user/role", formData)
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
                            window.location.href = "/lapmsv1/user/role";
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
                            toastr.error("User Role name already exist", "Error", {
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

        updateRole(id) {
            this.isLoading = true;
            const formData = new FormData();
            formData.append("user_role", this.formData.user_role);
            formData.append("selectedPermissions", this.formData.selectedPermissions);


            let delay = 2000;
            setTimeout(() => {
                axios
                    .post("/lapmsv1/api/update/user/role/" + this.formData.id, formData)
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
                            window.location.href = "/lapmsv1/user/role";
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
                            toastr.error("User Role name already exist", "Error", {
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



        saveRole() {
            console.log('Error');
        },
        openModal(mode, role) {
            // Reset the form data
            this.formData = {
                id: "",
                user_role: "",
                selectedPermissions: [],


                // Reset other form fields as needed
            };

            // Set the modal mode
            this.modalMode = mode;

            // Set the modal title based on the mode
            this.modalTitle =
                mode === "add"
                    ? "Create Role and Permissions"
                    : mode === "edit"
                        ? "Edit Role and Permissions"
                        : "View Tenant";

            if (mode === "edit") {
                // Populate formData with role data for editing
                this.formData.id = role.id;
                this.formData.user_role = role.name;
                this.formData.selectedPermissions = role.permission_id.split(',').map(id => parseInt(id));
            }

            // Set the view mode flag
            this.viewMode = mode === "view";

            // Show the modal
            $("#exampleModalCenter").modal("show");
        },

        closeModal() {
            // Close the modal
            $("#exampleModalCenter").modal("hide");
        },

    },
    data() {
        let sortOrders = {};
        let columns = [
            { width: "0%", label: "No", name: "id" },
            { width: "15%", label: "Role Name", name: "name" },
            { width: "15%", label: "Permissions", name: "permission" },
            { width: "15%", label: "Created At", name: "Created_At" },
            { width: "10%", label: "Status", name: "status" },
            { width: "10%", label: "Action", name: "action" },

        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });
        return {
            permissions: [],
            checkAll: "",
            modalMode: "add", // 'add' or 'edit'
            isLoading: false,
            modalTitle: "",
            formData: {
                id: "",
                user_role: "",
                selectedPermissions: [],
            },
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

            current_page: [],
            error: "",
            columns: columns,
            sortKey: "id",
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

        }

    },

    computed: {


    },
    created() {

    },
    mounted() {
        this.fetchPermissions();
        this.getData();
        console.log("Component Mounted");
    }
}
</script>
