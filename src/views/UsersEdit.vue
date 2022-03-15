<script>
import axios from "axios";

export default {
  data: function () {
    return {
      user: {},
      editUserParams: {},
      errors: [],
    };
  },
  created: function () {
    axios.get(`/users/${this.$route.params.id}`).then((response) => {
      console.log("User to edit:", response.data);
      this.user = response.data;
    });
  },
  methods: {
    updateUser: function () {
      axios
        .patch(`/users/${this.user.id}`, this.user)
        .then((response) => {
          console.log("Updated User:", response.data);
          localStorage.setItem("flashMessage", "User successfully updated!");
          this.$router.push(`/users/${this.user.id}`);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<template>
  <div class="users-edit">
    <form v-on:submit.prevent="updateUser()">
      <h1>Edit User</h1>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <!-- remove line below after testing is done  -->
      <p>Current user: {{ user }}</p>
      <p><img v-bind:src="user.image_url" alt="" /></p>
      <div>
        <label>User name:</label>
        <input type="text" v-model="user.user_name" />
      </div>
      <div>
        <label>Location:</label>
        <input type="text" v-model="user.location" />
      </div>
      <div>
        <label>Bio:</label>
        <input type="text" v-model="user.bio" />
      </div>
      <input type="submit" value="Update" />
    </form>
  </div>
</template>

<style></style>
