<script>
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
    });
  },
  methods: {},
};
</script>

<template>
  <div class="events-index">
    <h1>All Events</h1>
    <div v-for="event in events" v-bind:key="event.id">
      <h2>{{ event.yelp_venue }}</h2>
    </div>
  </div>
</template>

<style></style>
