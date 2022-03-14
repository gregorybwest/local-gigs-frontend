<script>
import axios from "axios";

export default {
  data: function () {
    return {
      event: {},
      editEventParams: {}, // do we need this?
      errors: [],
    };
  },
  created: function () {
    axios.get(`/events/${this.$route.params.id}`).then((response) => {
      console.log("Event to edit:", response.data);
      this.event = response.data;
    });
  },
  methods: {
    updateEvent: function () {
      axios
        .patch(`/events/${this.event.id}`, this.event)
        .then((response) => {
          console.log("Updated Event:", response.data);
          localStorage.setItem("flashMessage", "Event successfully updated!");
          this.$router.push(`/events/${this.event.id}`);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<template>
  <div class="events-edit">
    <form v-on:submit.prevent="updateEvent()">
      <h1>Edit Event</h1>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <!-- remove line below after testing is done  -->
      <p>Current event: {{ event }}</p>
      <p><img v-bind:src="event.flier_image_url" alt="" /></p>
      <div>
        <label>Show Time</label>
        <input type="text" v-model="event.show_time" />
      </div>
      <div>
        <label>Flier Image Url</label>
        <input type="text" v-model="event.flier_image_url" />
      </div>
      <input type="submit" value="Update" />
    </form>
  </div>
</template>

<style></style>
