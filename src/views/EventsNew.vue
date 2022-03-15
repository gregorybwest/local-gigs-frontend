<script>
import axios from "axios";

export default {
  data: function () {
    return {
      newEventParams: {},
      userVenue: "",
      noResultsMessage: "",
      displaySelectedVenue: "",
      venues: [],
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
          localStorage.setItem("flashMessage", "Event successfully created!");
        })
        .catch((error) => {
          this.sadStatus = error.response.status;
          this.errors = error.reponse.data.errors;
        });
    },
    searchVenue: function () {
      axios
        .get(`/venues?location=losangeles&categories=musicvenues,bars&term=${this.userVenue.replace(/ /g, "")}`) //removes all whitespace from user inputted string
        .then((response) => {
          console.log("Venue Data:", response.data);
          if (response.data.length === 0) {
            console.log("no search results");
            this.noResultsMessage = "No results found, check your spelling and try again!";
            return;
          }
          this.venues = response.data.slice(0, 5);
        });
    },
    chooseVenue: function (venue) {
      this.newEventParams.yelp_venue_id = venue.id;
      console.log("You chose:", venue.name);
      this.displaySelectedVenue = venue.name;
    },
  },
};
</script>

<template>
  <div class="events-new">
    <h1>Create New Event</h1>
    <form v-on:submit.prevent="searchVenue()">
      <h2>Search for your venue</h2>
      <div>
        Venue Search:
        <input v-model="this.userVenue" type="text" />
      </div>
      <button type="submit">Search</button>
      <br />
      <p v-for="venue in venues" v-bind:key="venue.id">
        {{ venue.name }}, {{ venue.location.display_address[0] }}
        <button v-on:click="chooseVenue(venue)">Choose Venue</button>
      </p>
      <br />
      <div v-if="displaySelectedVenue">
        <p>You selected: {{ displaySelectedVenue }}</p>
      </div>
      <div v-if="noResultsMessage">
        {{ noResultsMessage }}
        <button v-on:click="noResultsMessage = ''">Okay</button>
      </div>
    </form>

    <br />
    <br />
    <form v-on:submit.prevent="createEvent()">
      <!-- <div>
        Yelp Venue Id:
        <input v-model="newEventParams.yelp_venue_id" type="text" />
      </div> -->
      <div>
        Show time: (required)
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
