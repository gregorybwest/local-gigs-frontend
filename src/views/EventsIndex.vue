<script>
/* global mapboxgl */

import axios from "axios";

export default {
  data: function () {
    return {
      events: [],
    };
  },
  created: function () {
    axios.get("/events").then((response) => {
      console.log("events index:", response);
      this.events = response.data;
      mapboxgl.accessToken = process.env.VUE_APP_MAPBOX_ACCESS_TOKEN;
      const map = new mapboxgl.Map({
        container: "map", // container ID
        style: "mapbox://styles/mapbox/streets-v11", // style URL
        center: [-118.2437, 34.0522], // starting position [lng, lat]
        zoom: 9, // starting zoom
      });
      this.events.forEach((event) => {
        let popup_data = `<a href="/events/${event.id}">${event.user.user_name} @${event.yelp_venue.name}, ${event.readable_date}</a>`;
        const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(popup_data);
        const marker1 = new mapboxgl.Marker()
          .setLngLat([event.yelp_venue.coordinates.longitude, event.yelp_venue.coordinates.latitude])
          .setPopup(popup)
          .addTo(map);
        console.log(marker1);
      });
    });
  },
  methods: {},
};
</script>

<template>
  <div class="events-index">
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
                    <h1 class="breadcrumb-heading h5 font-weight-500">ALL EVENTS</h1>
                  </div>
                  <!-- /End Title -->

                  <!-- Breadcrumb -->
                  <nav class="breadcrumb-nav">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.html">
                          <span>Los Angeles</span>
                        </a>
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
                          <article class="main-block portfolio-block portfolio-block-inner format-standard">
                            <!-- Block container -->
                            <div class="main-block-container portfolio-block-container portfolio-block-inner-container">
                              <!-- Block body -->
                              <div class="main-block-body portfolio-block-body portfolio-block-inner-body">
                                <!-- Block heading -->
                                <div class="main-block-heading portfolio-block-heading portfolio-block-inner-heading">
                                  <div class="map">
                                    <h2>Local Gigs Map</h2>
                                    <div id="map"></div>
                                  </div>
                                  <br />
                                  <h1 style="text-align: center">All Events</h1>
                                  <br />
                                  <div style="text-align: center" v-for="event in events" v-bind:key="event.id">
                                    <h2>
                                      {{ event.readable_date }} {{ event.user.user_name }} @ {{ event.yelp_venue.name }}
                                      <br />
                                      <br />
                                      <router-link v-bind:to="`/events/${event.id}`">
                                        <button>View Event</button>
                                      </router-link>
                                    </h2>
                                    <p>{{ event.yelp_venue.location[0] }}</p>
                                    <p>{{ event.yelp_venue.location[1] }}</p>
                                  </div>
                                </div>
                                <!-- /End Block heading -->
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
    <!-- <div class="map">
      <h2>Local Gigs Map</h2>
      <div id="map"></div>
    </div>
    <h1>All Events</h1>
    <div v-for="event in events" v-bind:key="event.id">
      <h2>
        {{ event.readable_date }} {{ event.user.user_name }} @ {{ event.yelp_venue.name }}
        <router-link v-bind:to="`/events/${event.id}`">
          <button>View Event</button>
        </router-link>
      </h2>
      <p>{{ event.yelp_venue.location[0] }}</p>
      <p>{{ event.yelp_venue.location[1] }}</p>
    </div> -->
  </div>
</template>

<style>
#map {
  height: 500px;
  width: 100%;
}
</style>
