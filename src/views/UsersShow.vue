<script>
import axios from "axios";

export default {
  data: function () {
    return {
      user: {},
    };
  },
  created: function () {
    axios.get(`/users/${this.$route.params.id}`).then((response) => {
      console.log("Users Show:", response.data);
      this.user = response.data;
    });
  },
  methods: {},
};
</script>

<template>
  <div class="users-show">
    <h1>{{ user.user_name }}</h1>
    <img v-bind:src="user.image_url" alt="" />
    <h2>Upcoming Local Gigs:</h2>
    <div v-for="event in user.events" v-bind:key="event.id">
      <router-link v-bind:to="`/events/${event.id}`">
        <h3>{{ event.show_time }} @ {{ event.yelp_venue.name }}</h3>
      </router-link>
    </div>
    <div>
      <h2>Bio:</h2>
      <p>{{ user.bio }}</p>
      <h2>Listen!</h2>
      <a v-bind:href="user.spotify_link">Listen to us on Spotify!</a>
    </div>
  </div>
</template>

<style></style>
