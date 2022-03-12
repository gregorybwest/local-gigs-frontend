<script>
import axios from "axios";

export default {
  data: function () {
    return {
      newEventParams: {},
      userVenue: "",
      errors: [],
      sadStatus: "",
    };
  },
  created: function () {},
  methods: {
    createEvent: function () {
      axios
        .post("/events", this.newEventParams)
        .then((response) => {
          console.log("New Event:", response.data);
          localStorage.setItem("flashMessage", "Recipe successfully created!");
        })
        .catch((error) => {
          this.sadStatus = error.response.status;
          this.errors = error.reponse.data.errors;
        });
    },
    searchVenue: function () {
      axios.get(`/venues?location=losangeles&categories=musicvenues,bars&term=${this.userVenue}`).then((response) => {
        console.log("Venue Data:", response);
        this.userVenue = response.data;
      });
    },
  },
};
</script>

<template>
  <div class="events-new">
    <h1>Create New Event</h1>
    <form v-on:submit.prevent="createEvent()">
      {{ newEventParams.yelp_venue_id }}
      <div>
        Yelp Venue Id:
        <input v-model="newEventParams.yelp_venue_id" type="text" />
      </div>
      <div>
        Show time:
        <input v-model="newEventParams.show_time" type="text" />
      </div>
      <div>
        Flier image link:
        <input v-model="newEventParams.flier_image_url" type="text" />
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<style></style>
