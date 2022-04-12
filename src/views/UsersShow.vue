<script>
import axios from "axios";

export default {
  data: function () {
    return {
      user: {},
      sadStatus: "",
      current_user_id: localStorage.getItem("user_id"),
    };
  },
  created: function () {
    axios
      .get(`/users/${this.$route.params.id}`)
      .then((response) => {
        console.log("Users Show:", response.data);
        this.user = response.data;
      })
      .catch((error) => {
        this.sadStatus = error.response.status;
        this.errors = error.response.data.errors;
        console.log(this.sadStatus);
      });
  },
  methods: {
    destroyUser: function () {
      if (confirm("Are you sure you want to delete this?")) {
        axios.delete(`users/${this.user.id}`).then((response) => {
          console.log("User deleted", response.data);
          localStorage.removeItem("jwt");
          localStorage.removeItem("user_id");
          localStorage.setItem("flashMessage", "User successfully deleted");
          this.$router.push("/events");
        });
      }
    },
  },
};
</script>

<template>
  <div class="users-show">
    <!-- Breadcrumb section
                ============================================================ -->
    <div class="breadcrumb-section breadcrumb-section-layout-1 text-center">
      <!-- Breadcrumb container -->
      <div class="breadcrumb-section-container">
        <!-- container -->
        <div class="container gx-4">
          <!-- row -->
          <div class="row align-items-center justify-content-between">
            <!-- User Name -->
            <div class="breadcrumb-user name">
              <h1 class="breadcrumb-heading h5 font-weight-500">{{ user.user_name }}</h1>
            </div>
            <!-- /End User Name -->
          </div>
          <!-- /End row -->
        </div>
        <!-- /End container -->
      </div>
      <!-- /End Breadcrumb container -->
    </div>
    <!-- /End Breadcrumb section -->

    <!-- Page body
                ============================================================ -->
    <div id="page-body" class="page-body">
      <!-- container -->
      <div class="container gx-4">
        <!-- row -->
        <div class="row main-row justify-content-center">
          <!-- Content area
                            ================================================ -->
          <div id="primary" class="content-area col-lg-12">
            <!-- Main -->
            <main id="main" class="content-area-container site-main pt-72 pb-72">
              <!-- Shop wrapper -->
              <div class="shop-block-wrapper">
                <!-- row -->
                <div class="row gx-36">
                  <!-- Grid item -->
                  <div class="shop-block-post col-lg-12">
                    <!-- Post -->
                    <article class="main-block shop-block shop-block-inner shop-block-inner-sbs">
                      <!-- Block container -->
                      <div class="main-block-container shop-block-container shop-block-inner-container">
                        <!-- row -->
                        <div class="row gx-36" id="sticky-sidebar-wrapper">
                          <!-- col-lg-5 -->
                          <div class="col-lg-5 col-md-6">
                            <!-- Block header -->
                            <div
                              class="main-block-header shop-block-header shop-block-inner-header shop-block-inner-sbs-header"
                            >
                              <!-- Slider block -->
                              <div
                                class="owl-slider owl-carousel"
                                data-owl-slider-items-xl="1"
                                data-owl-slider-items-lg="1"
                                data-owl-slider-items-md="1"
                                data-owl-slider-items-sm="1"
                                data-owl-slider-items-xs="1"
                                data-owl-slider-items-margin="0"
                                data-owl-slider-loop="yes"
                                data-owl-slider-arrows="yes"
                                data-owl-slider-arrows-layout="layout-2"
                                data-owl-slider-autoplay="yes"
                                data-page-direction="ltr"
                                data-owl-slider-thumbnail="yes"
                              >
                                <!-- Slider item -->
                                <div class="owl-slider-item">
                                  <!-- Image block -->
                                  <div class="main-block image-block">
                                    <!-- Block container -->
                                    <div class="main-block-container image-block-container">
                                      <!-- Block header -->
                                      <div class="main-block-header image-block-header">
                                        <img v-bind:src="user.image_url" alt="" />
                                      </div>
                                      <!-- /End Block header -->
                                    </div>
                                    <!-- /End Block container -->
                                  </div>
                                  <!-- /End Image block -->
                                </div>
                                <!-- /End Slider item -->
                              </div>
                              <!-- /End Slider block -->
                            </div>
                            <!-- /End Block header -->
                          </div>
                          <!-- /End col-lg-5 -->

                          <!-- col-lg-7 -->
                          <div class="col-lg-7 col-md-6">
                            <!-- Block body -->
                            <div
                              class="main-block-body shop-block-body shop-block-inner-body shop-block-inner-sbs-body"
                            >
                              <!-- Block heading -->
                              <div class="main-block-heading shop-block-heading shop-block-inner-heading">
                                <h2>
                                  {{ user.user_name }}
                                </h2>
                              </div>
                              <!-- /End Block heading -->

                              <!-- Block content -->
                              <div class="main-block-content shop-block-content shop-block-inner-content">
                                <!-- Price -->
                                <h4 class="product-price">
                                  <span>
                                    <ins>
                                      <span>
                                        <p v-if="user.spotify_link !== null">
                                          <a v-bind:href="user.spotify_link">Listen on Spotify!</a>
                                        </p>
                                      </span>
                                    </ins>
                                  </span>
                                </h4>
                                <!-- /End Price -->

                                <!-- Short description -->
                                <p style="padding-bottom: 40px" class="product-description">
                                  {{ this.user.bio }}
                                </p>

                                <!-- info -->
                                <div v-if="user.events.length > 0">
                                  <h2 style="text-align: center">Upcoming Local Gigs:</h2>
                                  <div class="border-bottom" v-for="event in user.events" v-bind:key="event.id">
                                    <router-link v-bind:to="`/events/${event.id}`">
                                      <h4 style="text-align: center">
                                        {{ event.readable_date }} @ {{ event.yelp_venue.name }}
                                      </h4>
                                    </router-link>
                                  </div>
                                </div>
                                <div style="text-align: center" v-if="current_user_id == user.id">
                                  <button>
                                    <router-link v-bind:to="`/users/${user.id}/edit`">Edit Profile</router-link>
                                  </button>
                                  <br />
                                  <button v-on:click="destroyUser()">Delete Account</button>
                                </div>
                                <!-- /End info -->
                              </div>
                              <!-- /End Block content -->
                            </div>
                            <!--/End Block body -->
                          </div>
                          <!-- /End col-lg-7 -->
                        </div>
                        <!-- /End row -->
                      </div>
                      <!-- /End Block container -->
                    </article>
                    <!-- /End Post -->
                  </div>
                  <!-- /End Grid item -->
                </div>
                <!-- /End row -->
              </div>
              <!-- /End Shop wrapper -->
            </main>
            <!-- /End Main -->
          </div>
          <!-- /End Content area -->
        </div>
        <!-- /End row -->
      </div>
      <!-- /End container -->
    </div>
    <!-- /End Page body -->

    <img
      v-if="sadStatus == 404"
      v-bind:src="`https://images.squarespace-cdn.com/content/v1/51ee39dfe4b06fd80f3c7853/1401775637096-CQJRAGQQ32HR741L1BIV/image-asset.jpeg?format=1500w`"
      alt=""
    />
    <!-- <h1>{{ user.user_name }}</h1>
    <img v-bind:src="user.image_url" alt="" />
    <div v-if="user.events.length > 0">
      <h2>Upcoming Local Gigs:</h2>
      <div v-for="event in user.events" v-bind:key="event.id">
        <router-link v-bind:to="`/events/${event.id}`">
          <h3>{{ event.readable_date }} @ {{ event.yelp_venue.name }}</h3>
        </router-link>
      </div>
    </div>
    <div>
      <h2>Bio:</h2>
      <p>{{ user.bio }}</p>
      <div v-if="user.spotify_link !== null">
        <h2>Listen!</h2>
        <a v-bind:href="user.spotify_link">Listen to us on Spotify!</a>
      </div>
    </div>
    <br />
    <div v-if="current_user_id == user.id">
      <button>
        <router-link v-bind:to="`/users/${user.id}/edit`">Edit Profile</router-link>
      </button>
      <br />
      <button v-on:click="destroyUser()">Delete Account</button>
    </div> -->
  </div>
</template>

<style></style>
