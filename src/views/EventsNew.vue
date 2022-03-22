<script>
import axios from "axios";

export default {
  data: function () {
    return {
      newEventParams: {},
      userVenue: "",
      noResultsMessage: "",
      displaySelectedVenue: "",
      venues: [],
      errors: [],
      sadStatus: "",
    };
  },
  created: function () {},
  methods: {
    createEvent: function () {
      axios
        .post("/events", this.newEventParams)
        .then((response) => {
          console.log("New Event:", response.data);
          localStorage.setItem("flashMessage", "Event successfully created!");
          this.$router.push(`/events/${response.data.id}`);
        })
        .catch((error) => {
          this.sadStatus = error.response.status;
          this.errors = error.reponse.data.errors;
        });
    },
    searchVenue: function () {
      axios
        .get(`/venues?location=losangeles&categories=musicvenues,bars&term=${this.userVenue.replace(/ /g, "")}`) //removes all whitespace from user inputted string
        .then((response) => {
          console.log("Venue Data:", response.data);
          if (response.data.length === 0) {
            console.log("no search results");
            this.noResultsMessage = "No results found, check your spelling and try again!";
            return;
          }
          this.venues = response.data.slice(0, 5);
        });
    },
    chooseVenue: function (venue) {
      this.newEventParams.yelp_venue_id = venue.id;
      console.log("You chose:", venue.name);
      this.displaySelectedVenue = venue.name;
    },
  },
};
</script>

<template>
  <div class="events-new">
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
                    <h1 class="breadcrumb-heading h5 font-weight-500">Create new event</h1>
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

                      <li class="breadcrumb-item active"><span>New Events</span></li>
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
                                      <h1>Create New Event</h1>
                                      <form v-on:submit.prevent="searchVenue()">
                                        <h2>Search for your venue</h2>
                                        <div style="text-align: left">
                                          Venue Search:
                                          <input v-model="this.userVenue" type="text" />
                                          <button type="submit">Search</button>
                                        </div>
                                        <div class="container"><br /></div>
                                        <div v-for="venue in venues" v-bind:key="venue.id">
                                          {{ venue.name }}, {{ venue.location.display_address[0] }}
                                          <button v-on:click="chooseVenue(venue)">Choose Venue</button>
                                        </div>
                                        <div class="container"></div>
                                        <div>
                                          <br />
                                          <div v-if="displaySelectedVenue">
                                            You selected: {{ displaySelectedVenue }}
                                          </div>
                                          <br />
                                          <div v-if="noResultsMessage">
                                            {{ noResultsMessage }}
                                            <button v-on:click="noResultsMessage = ''">Okay</button>
                                          </div>
                                        </div>
                                      </form>

                                      <br />
                                      <br />
                                      <form v-on:submit.prevent="createEvent()">
                                        <!-- <div>
                                          Yelp Venue Id:
                                          <input v-model="newEventParams.yelp_venue_id" type="text" />
                                        </div> -->
                                        <div>
                                          Show time: (required)
                                          <input v-model="newEventParams.show_time" type="datetime-local" />
                                        </div>
                                        <div class="container"><br /></div>
                                        <div>
                                          Flier image link:
                                          <input v-model="newEventParams.flier_image_url" type="text" />
                                        </div>
                                        <button type="submit">Submit</button>
                                      </form>
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
    <!-- /End body -->
    <!-- <h1>Create New Event</h1>
    <form v-on:submit.prevent="searchVenue()">
      <h2>Search for your venue</h2>
      <div>
        Venue Search:
        <input v-model="this.userVenue" type="text" />
      </div>
      <button type="submit">Search</button>
      <br />
      <p v-for="venue in venues" v-bind:key="venue.id">
        {{ venue.name }}, {{ venue.location.display_address[0] }}
        <button v-on:click="chooseVenue(venue)">Choose Venue</button>
      </p>
      <br />
      <div v-if="displaySelectedVenue">
        <p>You selected: {{ displaySelectedVenue }}</p>
      </div>
      <div v-if="noResultsMessage">
        {{ noResultsMessage }}
        <button v-on:click="noResultsMessage = ''">Okay</button>
      </div>
    </form>

    <br />
    <br />
    <form v-on:submit.prevent="createEvent()">
      <div>
        Yelp Venue Id:
        <input v-model="newEventParams.yelp_venue_id" type="text" />
      </div>
      <div>
        Show time: (required)
        <input v-model="newEventParams.show_time" type="datetime-local" />
      </div>
      <div>
        Flier image link:
        <input v-model="newEventParams.flier_image_url" type="text" />
      </div>
      <button type="submit">Submit</button>
    </form> -->
  </div>
</template>

<style></style>
