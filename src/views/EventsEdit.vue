<script>
import axios from "axios";

export default {
  data: function () {
    return {
      event: {},
      editEventParams: {}, // do we need this?
      errors: [],
    };
  },
  created: function () {
    axios.get(`/events/${this.$route.params.id}`).then((response) => {
      console.log("Event to edit:", response.data);
      this.event = response.data;
    });
  },
  methods: {
    updateEvent: function () {
      axios
        .patch(`/events/${this.event.id}`, this.event)
        .then((response) => {
          console.log("Updated Event:", response.data);
          localStorage.setItem("flashMessage", "Event successfully updated!");
          this.$router.push(`/events/${this.event.id}`);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<template>
  <div class="events-edit">
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
                    <h1 class="breadcrumb-heading h5 font-weight-500">Edit event</h1>
                  </div>
                  <!-- /End Title -->

                  <!-- Breadcrumb -->
                  <nav class="breadcrumb-nav">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.html">
                          <span>Local Gigs</span>
                        </a>
                      </li>

                      <li class="breadcrumb-item active"><span>Edit Event</span></li>
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
                          <article class="main-block portfolio-block portfolio-block-inner format-standard">
                            <!-- Block container -->
                            <div class="main-block-container portfolio-block-container portfolio-block-inner-container">
                              <!-- Block body -->
                              <div class="main-block-body portfolio-block-body portfolio-block-inner-body">
                                <!-- Block content -->
                                <div class="main-block-content portfolio-block-content portfolio-block-inner-content">
                                  <!-- row -->
                                  <div class="row gx-36 flex-row-reverse">
                                    <!-- info -->
                                    <div class="col-lg-6 info"></div>
                                    <!-- /End info -->

                                    <!-- description -->
                                    <div class="col-lg-6 description">
                                      <form v-on:submit.prevent="updateEvent()">
                                        <h1>Edit Event</h1>
                                        <ul>
                                          <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                                        </ul>
                                        <!-- <p>Current event: {{ event }}</p> -->
                                        <p><img v-bind:src="event.flier_image_url" alt="" /></p>
                                        <div>
                                          <label>Show Time</label>
                                          <input type="datetime-local" v-model="event.show_time" />
                                        </div>
                                        <div class="container"><br /></div>
                                        <div>
                                          <label>Flier Image Url</label>
                                          <input type="text" v-model="event.flier_image_url" />
                                        </div>
                                        <input type="submit" value="Update" />
                                      </form>

                                      <br />
                                      <br />
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <!-- /End description -->
                                  </div>
                                  <!-- /End row -->
                                </div>
                                <!-- /End Block content -->
                              </div>
                              <!--/End Block body -->
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
    <!-- <form v-on:submit.prevent="updateEvent()">
      <h1>Edit Event</h1>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <p>Current event: {{ event }}</p>   COMMENT THIS LINE OUT
      <p><img v-bind:src="event.flier_image_url" alt="" /></p>
      <div>
        <label>Show Time</label>
        <input type="datetime-local" v-model="event.show_time" />
      </div>
      <div>
        <label>Flier Image Url</label>
        <input type="text" v-model="event.flier_image_url" />
      </div>
      <input type="submit" value="Update" />
    </form> -->
  </div>
</template>

<style></style>
