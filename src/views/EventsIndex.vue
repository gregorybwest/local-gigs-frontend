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
      <h2>
        {{ event.show_time }} {{ event.user.user_name }} @ {{ event.yelp_venue.name }}
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

<style></style>
