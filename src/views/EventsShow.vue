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
    <!-- body
    ======================================================================== -->
    <body>
      <!-- Main wrapper
        ==================================================================== -->
      <div id="main-wrapper">
        <!-- Main container -->
        <div id="main-container">
          <!-- Back to top button
                ============================================================ -->
          <a href="#" id="back-to-top" class="back-to-top" title="Back to top"></a>

          <!-- Header
                ============================================================ -->
          <header class="header-section header-section-fixed">
            <!-- Header section container -->
            <div class="header-section-container">
              <!-- Header menu section -->
              <div class="header-menu-section">
                <!-- Header menu section container -->
                <div class="header-menu-section-container"></div>
                <!-- /End Header menu section container -->
              </div>
              <!-- /End Header menu section -->
            </div>
            <!-- /End Header section container -->
          </header>
          <!-- /End Header section -->

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
                    <!-- Portfolio wrapper -->
                    <div class="portfolio-block-wrapper">
                      <!-- row -->
                      <div class="row gx-36">
                        <!-- Grid item -->
                        <div class="portfolio-block-post col-lg-12">
                          <!-- Post -->
                          <article
                            class="main-block portfolio-block portfolio-block-inner portfolio-block-inner-sbs format-standard"
                          >
                            <!-- Block container -->
                            <div class="main-block-container portfolio-block-container portfolio-block-inner-container">
                              <!-- row -->
                              <div class="row gx-36" id="sticky-sidebar-wrapper">
                                <!-- col-lg-8 -->
                                <div class="col-lg-8">
                                  <!-- Block header -->
                                  <div
                                    class="main-block-header portfolio-block-header portfolio-block-inner-header portfolio-block-inner-sbs-header"
                                  >
                                    <img v-bind:src="this.event.flier_image_url" alt="Article image" />
                                  </div>
                                  <!-- /End Block header -->
                                </div>
                                <!-- /End col-lg-8 -->

                                <!-- col-lg-4 -->
                                <div class="col-lg-4" id="sticky-sidebar">
                                  <!-- Block body -->
                                  <div
                                    class="main-block-body portfolio-block-body portfolio-block-inner-body portfolio-block-inner-sbs-body sticky-sidebar-container"
                                  >
                                    <!-- Block heading -->
                                    <div
                                      class="main-block-heading portfolio-block-heading portfolio-block-inner-heading"
                                    >
                                      <router-link v-bind:to="`/users/${event.user.id}`">
                                        <h1>{{ this.event.user.user_name }}</h1>
                                      </router-link>

                                      <h1>@ {{ this.event.yelp_venue.name }}</h1>
                                      <br />
                                      <h2>
                                        {{ this.event.yelp_venue.location[0] }}, {{ this.event.yelp_venue.location[1] }}
                                      </h2>
                                      <br />
                                      <h3>Show Time: {{ event.readable_date }}</h3>
                                      <div v-if="event.owner">
                                        <button>
                                          <router-link v-bind:to="`/events/${event.id}/edit`">Edit Event</router-link>
                                        </button>
                                        |
                                        <button v-on:click="destroyEvent()">Delete Event</button>
                                      </div>
                                    </div>
                                    <!-- /End Block heading -->
                                  </div>
                                  <!--/End Block body -->
                                </div>
                                <!-- /End col-lg-4 -->
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
                    <!-- /End Portfolio wrapper -->
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
        </div>
        <!-- /End Main container -->
      </div>
      <!-- /End Main wrapper -->
    </body>
    <!-- /End body -->
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
