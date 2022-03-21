<script>
import axios from "axios";

export default {
  data: function () {
    return {
      newUserParams: {},
      errors: [],
    };
  },
  methods: {
    submit: function () {
      axios
        .post("/users", this.newUserParams)
        .then((response) => {
          console.log(response.data);
          localStorage.setItem("flashMessage", "Sucessfully signed up!");
          this.$router.push("/login");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<template>
  <div class="signup">
    <!-- body
    ======================================================================== -->
    <body>
      <!-- Main wrapper
        ==================================================================== -->
      <div id="main-wrapper">
        <!-- Main container -->
        <div id="main-container">
          <!-- Page body
                ============================================================ -->
          <div id="page-body" class="page-body">
            <!-- row -->
            <div class="row main-row justify-content-center">
              <!-- Content area
                        ==================================================== -->
              <div id="primary" class="content-area col-lg-12">
                <!-- Main -->
                <main id="main" class="content-area-container site-main">
                  <!-- Section -->
                  <div class="main-section pt-0 pb-0">
                    <!-- Media (Background) -->
                    <div class="section-media section-media-bg">
                      <!-- Owl slider -->
                      <div
                        class="owl-slider owl-carousel"
                        data-owl-slider-items-xl="1"
                        data-owl-slider-items-lg="1"
                        data-owl-slider-items-md="1"
                        data-owl-slider-items-sm="1"
                        data-owl-slider-items-xs="1"
                        data-owl-slider-items-margin="0"
                        data-owl-slider-loop="yes"
                        data-owl-slider-autoplay="yes"
                        data-owl-slider-animateIn="fadeIn"
                        data-owl-slider-animateOut="fadeOut"
                        data-owl-slider-mouseDrag="no"
                        data-owl-slider-touchDrag="no"
                        data-page-direction="ltr"
                      >
                        <!-- Slider item -->
                        <div class="owl-slider-item" style="background-image: url(assets/images/pages/022.jpg)"></div>
                        <!-- /End Slider item -->

                        <!-- Slider item -->
                        <div class="owl-slider-item" style="background-image: url(assets/images/pages/023.jpg)"></div>
                        <!-- /End Slider item -->

                        <!-- Slider item -->
                        <div class="owl-slider-item" style="background-image: url(assets/images/pages/024.jpg)"></div>
                        <!-- /End Slider item -->
                      </div>
                      <!-- /End Owl slider -->
                    </div>
                    <!-- /End Media (Background) -->

                    <!-- overlay -->
                    <div class="section-overlay dark-1-color-bg" style="opacity: 0.8"></div>

                    <!-- container -->
                    <div class="container gx-4">
                      <!-- row -->
                      <div class="row gx-36 height-lg-100vh align-items-center justify-content-center">
                        <!-- col-lg-12 -->
                        <div class="col-lg-12">
                          <!-- GAP -->
                          <div class="gap gap-36"></div>

                          <!-- Sign form -->
                          <div class="form-block form-block-validation form-block-sign">
                            <!-- Form container -->
                            <div class="form-block-container">
                              <!-- Logo -->
                              <h1 class="form-block-sign-logo light-color">
                                <a href="index.html" title="Bason">
                                  <h1>Welcome to Local Gigs!</h1>
                                </a>
                              </h1>
                              <!-- /End Logo -->

                              <!-- Form -->
                              <form v-on:submit.prevent="submit()" class="row form-block-sign-form">
                                <br />
                                <h3>Signup to Post Your Events!</h3>
                                <ul>
                                  <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                                </ul>
                                <!-- Name -->
                                <div class="col-md-12">
                                  <label class="label">
                                    Name
                                    <input
                                      class="form-control"
                                      type="text"
                                      v-model="newUserParams.user_name"
                                      name="form_user_name"
                                    />
                                  </label>
                                </div>
                                <!-- /End Name -->

                                <!-- Email Address -->
                                <div class="col-md-12">
                                  <label class="label">
                                    Email Address
                                    <input
                                      class="form-control"
                                      type="email"
                                      v-model="newUserParams.email"
                                      name="form_user_email"
                                    />
                                  </label>
                                </div>
                                <!-- /End Email Address -->

                                <!-- Location -->
                                <div class="col-md-12">
                                  <label class="label">
                                    City
                                    <input
                                      class="form-control"
                                      type="text"
                                      v-model="newUserParams.location"
                                      name="form_user_location"
                                    />
                                  </label>
                                </div>
                                <!-- /End Location -->

                                <!-- Is Artist? -->
                                <div class="col-md-12">
                                  <label class="label">
                                    Are you an artist?
                                    <form action="is_artist?">
                                      <input
                                        class="form-control"
                                        type="radio"
                                        v-model="newUserParams.is_artist"
                                        id="yes"
                                        name="is_artist?"
                                        value="true"
                                      />
                                      <label for="yes">Yes</label>
                                      <br />
                                      <input
                                        class="form-control"
                                        type="radio"
                                        v-model="newUserParams.is_artist"
                                        id="no"
                                        name="is_artist?"
                                        value="false"
                                      />
                                      <label for="no">No</label>
                                    </form>
                                  </label>
                                </div>
                                <!-- /End Is Artist? -->

                                <!-- Password -->
                                <div class="col-md-12">
                                  <label class="label">
                                    Password
                                    <input
                                      class="form-control"
                                      type="password"
                                      v-model="newUserParams.password"
                                      name="form_user_password"
                                    />
                                  </label>
                                </div>
                                <!-- /End Password -->

                                <!-- Password Confirmation -->
                                <div class="col-md-12">
                                  <label class="label">
                                    Password Confirmation
                                    <input
                                      class="form-control"
                                      type="password"
                                      v-model="newUserParams.password_confirmation"
                                      name="form_user_password_confirmation"
                                    />
                                  </label>
                                </div>
                                <!-- /End Password Confirmation -->

                                <!-- Submit button -->
                                <div class="col-lg-12">
                                  <button type="submit" value="Submit" class="btn btn-accent btn-block">
                                    <span>SIGN UP</span>
                                  </button>
                                </div>
                                <!-- /End Submit button -->
                              </form>
                              <!-- /End Form -->
                            </div>
                            <!-- /End Form container -->
                          </div>
                          <!-- /End Sign form -->
                        </div>
                        <!-- /End col-lg-12 -->
                      </div>
                      <!-- /End row -->
                    </div>
                    <!-- /End container -->
                  </div>
                  <!-- /End Section -->
                </main>
                <!-- /End Main -->
              </div>
              <!-- /End Content area -->
            </div>
            <!-- /End row -->
          </div>
          <!-- /End Page body -->
        </div>
        <!-- /End Main container -->
      </div>
      <!-- /End Main wrapper -->
    </body>
    <!-- /End body -->
    <!-- <form v-on:submit.prevent="submit()">
      <h1>Welcome to Local Gigs!</h1>
      <br />
      <h2>Signup to Post Your Events!</h2>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <div>
        <label>Name:</label>
        <input type="text" v-model="newUserParams.user_name" />
      </div>
      <div>
        <label>Email:</label>
        <input type="email" v-model="newUserParams.email" />
      </div>
      <div>
        <label>City:</label>
        <input type="text" v-model="newUserParams.location" />
      </div>
      <div>
        <p>Are you an artist?</p>
        <form action="is_artist?">
          <input type="radio" v-model="newUserParams.is_artist" id="yes" name="is_artist?" value="true" />
          <label for="yes">Yes</label>
          <br />
          <input type="radio" v-model="newUserParams.is_artist" id="no" name="is_artist?" value="false" />
          <label for="no">No</label>
          <br />
        </form>
      </div>
      <div>
        <label>Password:</label>
        <input type="password" v-model="newUserParams.password" />
      </div>
      <div>
        <label>Password confirmation:</label>
        <input type="password" v-model="newUserParams.password_confirmation" />
      </div>
      <input type="submit" value="Submit" />
    </form> -->
  </div>
</template>
