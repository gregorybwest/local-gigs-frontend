<script>
import axios from "axios";

export default {
  data: function () {
    return {
      newSessionParams: {},
      errors: [],
    };
  },
  methods: {
    submit: function () {
      axios
        .post("/sessions", this.newSessionParams)
        .then((response) => {
          axios.defaults.headers.common["Authorization"] = "Bearer " + response.data.jwt;
          localStorage.setItem("jwt", response.data.jwt);
          localStorage.setItem("user_id", response.data.user_id); // for edit users show page
          localStorage.setItem("flashMessage", "Sucessfully logged in!");
          this.$router.push("/");
        })
        .catch((error) => {
          console.log(error.response);
          this.errors = ["Invalid email or password."];
          this.email = "";
          this.password = "";
        });
    },
  },
};
</script>

<template>
  <div class="login">
    <!-- head
    ======================================================================== -->
    <head>
      <!-- Basic Info
        ==================================================================== -->
      <title>Bason - Pages Sign in</title>

      <meta name="author" content="Graphicfort" />
      <meta name="robots" content="index follow" />
      <meta name="googlebot" content="index follow" />
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta
        name="keywords"
        content="bason, HTML5, CSS3, Creative, MultiPurpose, Template, create professional website fast"
      />
      <meta name="description" content="HTML5 MultiPurpose Template, create professional website fast" />

      <!-- Mobile Configurations
        ==================================================================== -->
      <meta name="apple-mobile-web-app-capable" content="yes" />
      <meta name="apple-mobile-web-app-status-bar-style" content="black" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <!-- fav icon
        ==================================================================== -->
      <link rel="icon" href="assets/images/favicon/favicon-32x32.png" sizes="32x32" />
      <link rel="icon" href="assets/images/favicon/favicon-192x192.png" sizes="192x192" />
      <link rel="apple-touch-icon" href="assets/images/favicon/favicon-180x180.png" />
      <meta name="msapplication-TileImage" content="assets/images/favicon/favicon-270x270.png" />

      <!-- Google Fonts
        ==================================================================== -->
      <link rel="preconnect" href="https://fonts.gstatic.com" />
      <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet"
      />

      <!--  CSS Files
        ==================================================================== -->
      <link rel="stylesheet" href="assets/js/vendor/bootstrap/css/bootstrap.min.css" />

      <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css" />
      <link rel="stylesheet" href="assets/js/plugins/fancybox/css/jquery.fancybox.min.css" />
      <link rel="stylesheet" href="assets/js/plugins/mediaelementplayer/css/mediaelementplayer.min.css" />
      <link rel="stylesheet" href="assets/js/plugins/twenty-twenty/css/twentytwenty.min.css" />
      <link rel="stylesheet" href="assets/js/plugins/owl-carousel/assets/owl.carousel.min.css" />
      <link rel="stylesheet" href="assets/js/plugins/owl-carousel/assets/owl.theme.default.min.css" />
      <link rel="stylesheet" href="assets/css/social-networks/social-networks.min.css" />
      <link rel="stylesheet" href="assets/css/animate/animate.min.css" />

      <link rel="stylesheet" href="assets/css/style.css" />
      <link rel="stylesheet" href="assets/css/custom.css" />
    </head>
    <!-- /End head -->

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
                                  <img src="assets/images/logo-sign.png" alt="Bason" />
                                </a>
                              </h1>
                              <!-- /End Logo -->

                              <!-- Form -->
                              <form v-on:submit.prevent="submit()" class="row form-block-sign-form">
                                <h1>Login</h1>
                                <!-- Errors -->
                                <ul>
                                  <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                                </ul>
                                <!-- Username or Email Address -->
                                <div class="col-md-12">
                                  <label class="label">
                                    Email Address
                                    <input
                                      class="form-control"
                                      type="email"
                                      v-model="newSessionParams.email"
                                      name="form_user_login"
                                    />
                                  </label>
                                </div>
                                <!-- /End Username or Email Address -->

                                <!-- Password -->
                                <div class="col-md-12">
                                  <label class="label">
                                    Password
                                    <input
                                      class="form-control"
                                      type="password"
                                      v-model="newSessionParams.password"
                                      name="form_user_pass"
                                    />
                                  </label>
                                </div>
                                <!-- /End Password -->

                                <!-- Submit button -->

                                <div class="col-lg-12">
                                  <button type="submit" value="Submit" class="btn btn-accent btn-block">
                                    <span>LOG IN</span>
                                  </button>
                                </div>
                                <!-- /End Submit button -->
                              </form>
                              <!-- /End Form -->

                              <!-- /End Links -->
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
      <h1>Login</h1>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <div>
        <label>Email:</label>
        <input type="email" v-model="newSessionParams.email" />
      </div>
      <div>
        <label>Password:</label>
        <input type="password" v-model="newSessionParams.password" />
      </div>
      <input type="submit" value="Submit" />
    </form> -->
  </div>
</template>
