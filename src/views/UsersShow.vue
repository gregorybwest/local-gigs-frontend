<script>
import axios from "axios";

export default {
  data: function () {
    return {
      user: {},
      current_user_id: localStorage.getItem("user_id"),
    };
  },
  created: function () {
    axios.get(`/users/${this.$route.params.id}`).then((response) => {
      console.log("Users Show:", response.data);
      this.user = response.data;
    });
  },
  methods: {
    destroyUser: function () {
      if (confirm("Are you sure you want to delete this?")) {
        axios.delete(`users/${this.user.id}`).then((response) => {
          console.log("User deleted", response.data);
          localStorage.removeItem("jwt");
          localStorage.removeItem("user_id");
          localStorage.setItem("flashMessage", "User successfully deleted");
          this.$router.push("/");
        });
      }
    },
  },
};
</script>

<template>
  <div class="users-show">
    <h1>{{ user.user_name }}</h1>
    <img v-bind:src="user.image_url" alt="" />
    <h2>Upcoming Local Gigs:</h2>
    <div v-for="event in user.events" v-bind:key="event.id">
      <router-link v-bind:to="`/events/${event.id}`">
        <h3>{{ event.readable_date }} @ {{ event.yelp_venue.name }}</h3>
      </router-link>
    </div>
    <div>
      <h2>Bio:</h2>
      <p>{{ user.bio }}</p>
      <h2>Listen!</h2>
      <a v-bind:href="user.spotify_link">Listen to us on Spotify!</a>
    </div>
    <br />
    <div v-if="current_user_id == user.id">
      <button>
        <router-link v-bind:to="`/users/${user.id}/edit`">Edit Profile</router-link>
      </button>
      <br />
      <button v-on:click="destroyUser()">Delete Account</button>
    </div>
  </div>
</template>

<style></style>
