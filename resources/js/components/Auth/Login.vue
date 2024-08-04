<template>
   <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
					
                  <span class="app-brand-text demo text-body fw-bolder">Company Logo</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to Company Name! 👋</h4>
              <p class="mb-4">Please sign-in to your account</p>

              <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="email"
                    placeholder="Enter your Email Address"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                   
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      v-model="password"
                      class="form-control"
                        placeholder="Enter Password"
                   
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="button"
                  @click.prevent="loginUser">
                  <span v-if="isLoading">
                                                <i class="fa fa-spinner"></i> Loading Please Wait
                                            </span>
                                            <span v-else> <i class="fa fa-check"></i> Sign In </span>
                 </button>
                </div>
              </form>

             
            </div>
          </div>
</template>

<script>
import toastr from 'toastr';
import 'toastr/build/toastr.css';
export default {

    methods: {

        loginUser() {
            this.isLoading = true;
            const data = {
                email: this.email,
                password: this.password,
            };
            let delay = 1000;

            setTimeout(() => {
                axios.post('/property_prime/api/post/login', data)
                    .then(response => {
                        this.user = response.data.user;
                        this.role = response.data.role;
                        this.permissions = response.data.permissions;
                      window.location.href = '/property_prime/property';

                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            if (error.response && error.response.status === 401) {
                                // Display toastr message for unauthorized access
                                toastr.error('You must log in first.', 'Unauthorized Access', { timeOut: 5000, closeButton: true });

                            }
                            if (error.response.data.message === 'Invalid credentials') {
                                // Display specific error message for invalid credentials
                                toastr.error('Invalid credentials. Please check your Email Address Or password. Try Again!', 'Error', { timeOut: 5000, closeButton: true });
                            } else {
                                // Handle other validation errors
                                if (error.response.data.errors && error.response.data.errors.email && error.response.data.errors.password) {
                                    // Display specific error message for email and password validation
                                    toastr.error(error.response.data.errors.password[0], 'Error', { timeOut: 5000, closeButton: true });
                                    toastr.error(error.response.data.errors.email[0], 'Error', { timeOut: 5000, closeButton: true });
                                } else if (error.response.data.errors && error.response.data.errors.email) {
                                    // Display specific error message for email validation
                                    toastr.error(error.response.data.errors.email[0], 'Error', { timeOut: 5000, closeButton: true });
                                } else if (error.response.data.errors && error.response.data.errors.password) {
                                    // Display specific error message for password validation
                                    toastr.error(error.response.data.errors.password[0], 'Error', { timeOut: 5000, closeButton: true });
                                } else {
                                    // Handle other validation errors
                                    this.errors = error.response.data.errors;
                                }
                            }
                        } else {
                            // Handle other errors
                            toastr.error('Something went wrong. Please try again later.', 'Error', { timeOut: 5000, closeButton: true });
                            console.error('Error:', error);
                        }
                    });


                this.isLoading = false;
            }, delay);
        },

    },
    data() {
        return {
            email: "",
            password: "",
            errors: {},
            isLoading: false,

        }
    },

    created() {

    },
    mounted() {
        axios.defaults.headers.common["X-CSRF-TOKEN"] = document.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        console.log("Component Mounted");
    }
}

</script>

<style scoped>
/* Add your component styles here */
.error {
    color: red;
    font-size: 0.875rem;
    /* Adjust the font size as needed */
}
</style>
