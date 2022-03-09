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
  <div class="home">
    <h1>{{ message }}</h1>
  </div>
</template>

<style></style>
