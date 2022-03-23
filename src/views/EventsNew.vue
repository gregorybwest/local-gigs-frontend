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
      <!-- row -->
      <div class="row main-row justify-content-center">
        <!-- Content area
                        ==================================================== -->
        <div id="primary" class="content-area col-lg-12">
          <!-- Main -->
          <main id="main" class="content-area-container site-main">
            <!-- Section -->
            <div class="main-section section-fullwidth pt-0 pb-0">
              <!-- container -->
              <div class="container-fluid gx-0">
                <!-- row -->
                <div class="row gx-36">
                  <!-- col-lg-12 -->
                  <div class="col-lg-12">
                    <div
                      class="hr-divider hr-divider-layout-3 hr-divider-1px-border hr-divider-fullwidth grey-2-color"
                    ></div>
                  </div>
                  <!-- /End col-lg-12 -->
                </div>
                <!-- /End row -->
              </div>
              <!-- /End container -->
            </div>
            <!-- /End Section -->

            <!-- Section -->
            <div class="main-section">
              <!-- container -->
              <div class="container gx-4">
                <!-- row -->
                <div class="row gx-36">
                  <!-- col-lg-8 -->
                  <div class="col-lg-8 offset-lg-2">
                    <!-- Section title -->
                    <div class="section-title text-center">
                      <!-- Section title container -->
                      <div class="section-title-container">
                        <!-- Section title body -->
                        <div class="section-title-body">
                          <!-- Section title heading -->
                          <div class="section-title-heading">
                            <h6 class="font-weight-500 accent-color">LOCAL GIGS</h6>
                            <h2>Create an event!</h2>
                          </div>
                          <!-- /End Section title heading -->

                          <!-- Divider -->
                          <div class="hr-divider hr-divider-layout-1 accent-color"></div>

                          <!-- Block content -->
                          <div class="section-title-content">
                            <p>Search for any music venue or bar in your city</p>
                          </div>
                          <!-- /End Block content -->
                        </div>
                        <!--/End Section title body -->
                      </div>
                      <!-- /End Section title container -->
                    </div>
                    <!-- /End Section title -->

                    <!-- GAP -->
                    <div class="gap gap-36"></div>
                  </div>
                  <!-- /End col-lg-8 -->

                  <!-- col-lg-8 -->
                  <div class="col-lg-8 offset-lg-2">
                    <!-- Contact form -->
                    <div class="form-block form-block-validation form-block-contact">
                      <!-- Form container -->
                      <div class="form-block-container">
                        <!-- Form -->
                        <form v-on:submit.prevent="searchVenue()" class="row">
                          <!-- VENUE SEARCH -->
                          <div style="padding-bottom: 60px" class="col-md-10">
                            <label class="label">
                              Venue Search
                              <span class="red-color">*</span>
                              <input v-model="this.userVenue" type="text" class="form-control" name="form_name" />
                              <button type="submit">Search</button>
                            </label>
                            <div v-for="venue in venues" v-bind:key="venue.id">
                              {{ venue.name }}, {{ venue.location.display_address[0] }}
                              <button v-on:click="chooseVenue(venue)">Choose Venue</button>
                            </div>
                            <div class="container"></div>
                            <div>
                              <div style="padding-top: 20px" v-if="displaySelectedVenue">
                                You selected: {{ displaySelectedVenue }}
                              </div>

                              <div v-if="noResultsMessage">
                                {{ noResultsMessage }}
                                <button style="padding-bottom: 100px" v-on:click="noResultsMessage = ''">Okay</button>
                              </div>
                            </div>
                          </div>
                          <!-- /End VENUES -->
                        </form>
                        <!-- /End Form -->
                        <form v-on:submit.prevent="createEvent()">
                          <!-- Show Time -->
                          <div class="col-md-6">
                            <label class="label">
                              Show Time
                              <span class="red-color">*</span>
                              <input
                                v-model="newEventParams.show_time"
                                class="form-control"
                                type="datetime-local"
                                name="form_email"
                              />
                            </label>
                          </div>
                          <!-- /End Show Time -->

                          <!-- Subject -->
                          <div class="col-lg-12">
                            <label class="label">
                              Flier Image Link
                              <span class="red-color">*</span>
                              <input
                                v-model="newEventParams.flier_image_url"
                                class="form-control"
                                type="text"
                                name="form_subject"
                              />
                            </label>
                          </div>
                          <!-- /End Subject -->

                          <!-- Submit button -->
                          <div class="col-lg-12">
                            <button type="submit" class="btn btn-accent btn-block">
                              <span>SUBMIT</span>
                              <!-- /End Submit button -->
                            </button>
                          </div>
                        </form>
                      </div>
                      <!-- /End Form container -->
                    </div>
                    <!-- /End Contact form -->
                  </div>
                  <!-- /End col-lg-8 -->
                </div>
                <!-- /End row -->
              </div>
              <!-- /End container -->
            </div>
            <!-- /End Section -->

            <!-- Section -->
            <div class="main-section pt-0 pb-0">
              <!-- container -->
              <div class="container-fluid gx-0">
                <!-- row -->
                <div class="row gx-36">
                  <!-- col-lg-12 -->
                  <div class="col-lg-12"></div>
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
