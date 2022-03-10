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
    <h1>{{ event.user.user_name }} @ {{ event.yelp_venue.name }}</h1>
    <h2>{{ event.yelp_venue.location[0] }}, {{ event.yelp_venue.location[1] }}</h2>
    <img v-bind:src="this.event.flier_image_url" alt="" />
  </div>
</template>

<style>
img {
  width: 400px;
  height: auto;
}
</style>
