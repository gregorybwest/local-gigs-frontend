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
      <!-- row -->
      <div class="row main-row justify-content-center">
        <!-- Content area
                        ==================================================== -->
        <div id="primary" class="content-area col-lg-12">
          <!-- Main -->
          <main id="main" class="content-area-container site-main">
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
                            <div id="map"></div>
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
            <!-- Section -->
            <div class="main-section pt-72 pb-72">
              <!-- container -->
              <div class="container gx-4">
                <!-- row -->
                <div class="row gx-36">
                  <!-- col-lg-12 -->
                  <div class="col-lg-12">
                    <!-- Blog wrapper -->
                    <div class="blog-block-wrapper blog-block-small-image blog-block-front blog-block-cols-1">
                      <!-- Loop -->
                      <div class="row gx-36 gy-0 row-cols-1 grid-wrapper">
                        <!-- Grid item -->
                        <div class="grid-item" v-for="event in events" v-bind:key="event.id">
                          <!-- Post -->
                          <article class="main-block blog-block format-standard">
                            <!-- Block container -->
                            <div class="main-block-container blog-block-container">
                              <!-- Block header -->
                              <div class="main-block-header blog-block-header">
                                <a href="#">
                                  <img :src="event.flier_image_url" alt="Article image" />
                                </a>
                              </div>
                              <!-- /End Block header -->

                              <!-- Block body -->
                              <div class="main-block-body blog-block-body">
                                <!-- Block heading -->
                                <div class="main-block-heading blog-block-heading">
                                  <h2 class="h5 title">
                                    <router-link v-bind:to="`/events/${event.id}`">
                                      {{ event.user.user_name }} @ {{ event.yelp_venue.name }}
                                    </router-link>
                                  </h2>

                                  <ul class="meta-block">
                                    <li class="meta-block-date">
                                      <span>
                                        <a href="#">{{ event.readable_date }}</a>
                                      </span>
                                    </li>

                                    <li class="meta-block-comments">
                                      <span>
                                        <a href="#">{{ event.user.location }}</a>
                                      </span>
                                    </li>
                                  </ul>
                                </div>
                                <!-- /End Block heading -->

                                <!-- Block content -->
                                <div class="main-block-content blog-block-content">
                                  <p>{{ event.yelp_venue.location[0] }}, {{ event.yelp_venue.location[1] }}</p>
                                </div>
                                <!-- /End Block content -->

                                <!-- Block footer -->
                                <div class="main-block-footer blog-block-footer">
                                  <router-link v-bind:to="`/events/${event.id}`" class="btn btn-accent btn-sm">
                                    <span>VIEW EVENT</span>
                                  </router-link>
                                  <router-link v-bind:to="`/events/${event.id}`" class="read-more-link font-size-12">
                                    <i class="fas fa-plus"></i>
                                    VIEW EVENT
                                  </router-link>
                                </div>
                                <!-- /End Block footer -->
                              </div>
                              <!--/End Block body -->
                            </div>
                            <!-- /End Block container -->
                          </article>
                          <!-- /End Post -->
                        </div>
                        <!-- /End Grid item -->
                      </div>
                      <!-- /End Loop -->
                    </div>
                    <!-- /End Blog wrapper -->
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
