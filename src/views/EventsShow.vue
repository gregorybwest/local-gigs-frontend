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
  methods: {},
};
</script>

<template>
  <div class="events-show">
    <router-link v-bind:to="`/users/${event.user.id}`">
      <h1>{{ this.event.user.user_name }}</h1>
    </router-link>
    <h1>@ {{ this.event.yelp_venue.name }}</h1>
    <h2>{{ this.event.yelp_venue.location[0] }}, {{ this.event.yelp_venue.location[1] }}</h2>
    <img v-bind:src="this.event.flier_image_url" alt="" />
    <div v-if="event.owner">
      <button><router-link v-bind:to="`/events/${event.id}/edit`">Edit</router-link></button>
      <br />
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
