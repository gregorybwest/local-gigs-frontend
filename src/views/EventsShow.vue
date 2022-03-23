<script>
import axios from "axios";

export default {
  data: function () {
    return {
      event: {},
    };
  },
  created: function () {
    axios.get(`/events/${this.$route.params.id}`).then((response) => {
      console.log("test", response.data);
      this.event = response.data;
    });
  },
  methods: {
    destroyEvent: function () {
      if (confirm("Are you sure you want to delete this?")) {
        axios.delete(`events/${this.event.id}`).then((response) => {
          console.log("Event deleted", response.data);
          localStorage.setItem("flashMessage", "Event successfully deleted");
          this.$router.push("/events");
        });
      }
    },
  },
};
</script>

<template>
  <div class="events-show">
    <!-- Breadcrumb section
                ============================================================ -->
    <div class="breadcrumb-section breadcrumb-section-layout-1 text-center">
      <!-- Breadcrumb container -->
      <div class="breadcrumb-section-container">
        <!-- container -->
        <div class="container gx-4">
          <!-- row -->
          <div class="row align-items-center justify-content-between">
            <!-- Title -->
            <div class="breadcrumb-title">
              <h1 class="breadcrumb-heading h5 font-weight-500">{{ this.event.user.user_name }}</h1>
            </div>
            <!-- /End Title -->

            <!-- Breadcrumb -->
            <nav class="breadcrumb-nav">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <p>
                    <span>Events</span>
                  </p>
                </li>
              </ol>
            </nav>
            <!-- /End Breadcrumb -->
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
                                        <img v-bind:src="this.event.flier_image_url" alt="Image" />
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
                                  <router-link v-bind:to="`/users/${event.user.id}`">
                                    {{ this.event.user.user_name }}
                                  </router-link>
                                  @ {{ this.event.yelp_venue.name }}
                                </h2>
                              </div>
                              <!-- /End Block heading -->

                              <!-- Block content -->
                              <div class="main-block-content shop-block-content shop-block-inner-content">
                                <!-- Price -->
                                <h4 class="product-price">
                                  <span class="price">
                                    <ins>
                                      <span class="amount">Show Time: {{ event.readable_date }}</span>
                                    </ins>
                                  </span>
                                </h4>
                                <!-- /End Price -->

                                <!-- Short description -->
                                <p class="product-description">
                                  {{ this.event.user.bio }}
                                </p>

                                <!-- info -->
                                <div class="info">
                                  <ul class="post-info-block post-info-block-layout-2">
                                    <li>
                                      <b>
                                        {{ this.event.yelp_venue.location[0] }}, {{ this.event.yelp_venue.location[1] }}
                                      </b>
                                    </li>
                                  </ul>
                                </div>
                                <div style="padding-top: 50px" v-if="event.owner">
                                  <button>
                                    <router-link v-bind:to="`/events/${event.id}/edit`">Edit Event</router-link>
                                  </button>
                                  |
                                  <button v-on:click="destroyEvent()">Delete Event</button>
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

    <!-- <router-link v-bind:to="`/users/${event.user.id}`">
      <h1>{{ this.event.user.user_name }}</h1>
    </router-link>
    <h1>@ {{ this.event.yelp_venue.name }}</h1>
    <h2>{{ this.event.yelp_venue.location[0] }}, {{ this.event.yelp_venue.location[1] }}</h2>
    <h3>Show Time: {{ event.readable_date }}</h3>
    <img v-bind:src="this.event.flier_image_url" alt="" />
    <div v-if="event.owner">
      <button><router-link v-bind:to="`/events/${event.id}/edit`">Edit Event</router-link></button>
      |
      <button v-on:click="destroyEvent()">Delete Event</button>
    </div> -->
  </div>
</template>

<style>
img {
  width: 400px;
  height: auto;
}
</style>
