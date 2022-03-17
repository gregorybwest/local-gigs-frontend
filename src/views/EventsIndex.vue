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
        zoom: 10, // starting zoom
      });
      this.events.forEach((event) => {
        console.log(event);
        let pop_data = `${event.user.user_name} @${event.yelp_venue.name}, ${event.readable_date}`;
        const popup = new mapboxgl.Popup({ offset: 25 }).setText(pop_data);
        console.log(popup);
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
    <div class="map">
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

      <h2></h2>
    </div>
  </div>
</template>

<style>
#map {
  height: 500px;
  width: 100%;
}
</style>
