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
    <router-link v-bind:to="`/users/${event.user.id}`">
      <h1>{{ this.event.user.user_name }}</h1>
    </router-link>
    <h1>@ {{ this.event.yelp_venue.name }}</h1>
    <h2>{{ this.event.yelp_venue.location[0] }}, {{ this.event.yelp_venue.location[1] }}</h2>
    <h3>Show Time: {{ event.show_time }}</h3>
    <img v-bind:src="this.event.flier_image_url" alt="" />
    <div v-if="event.owner">
      <button><router-link v-bind:to="`/events/${event.id}/edit`">Edit Event</router-link></button>
      |
      <button v-on:click="destroyEvent()">Delete Event</button>
    </div>
  </div>
</template>

<style>
img {
  width: 400px;
  height: auto;
}
</style>
