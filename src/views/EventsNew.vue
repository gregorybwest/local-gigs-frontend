<script>
import axios from "axios";

export default {
  data: function () {
    return {
      newEventParams: {},
      userVenue: "",
      allVenues: [],
      venueList: "",
      displayAllVenues: [],
      displayTopVenue: "",
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
      axios
        .get(`/venues?location=losangeles&categories=musicvenues,bars&term=${this.userVenue.replace(/ /g, "")}`) //removes all whitespace from user inputted string
        .then((response) => {
          console.log("Venue Data:", response.data);
          this.newEventParams.yelp_venue_id = response.data[0].id; // hard codes top result as venue
          this.allVenues = response.data.forEach((venue) => {
            console.log(venue.name); // console logs names of all venues found by yelp API
          });
          function listVenues(venueObject) {
            return `${venueObject.name}, ${venueObject.location.display_address}`; // function for .map
          }
          this.displayAllVenues = response.data.map(listVenues).slice(0, 5); //returns top 5 venue results from yelp
          // for (let i = 0; i < this.displayAllVenues.length; i++) {
          //   this.venueList = document.write(this.displayAllVenues[i] + "<br >");
          // } // this takes user to a separate page with a list of the venues, which we don't want
          this.displayTopVenue = `${response.data[0].name}, ${response.data[0].location.display_address}`;
        });
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
      {{ this.displayAllVenues }}
      {{ this.displayTopVenue }}
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
