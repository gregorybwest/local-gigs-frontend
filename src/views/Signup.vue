<script>
import axios from "axios";

export default {
  data: function () {
    return {
      newUserParams: {},
      errors: [],
    };
  },
  methods: {
    submit: function () {
      axios
        .post("/users", this.newUserParams)
        .then((response) => {
          console.log(response.data);
          localStorage.setItem("flashMessage", "Sucessfully signed up!");
          this.$router.push("/login");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<template>
  <div class="signup">
    <form v-on:submit.prevent="submit()">
      <h1>Welcome to Local Gigs!</h1>
      <br />
      <h2>Signup to Post Your Events!</h2>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <div>
        <label>Name:</label>
        <input type="text" v-model="newUserParams.user_name" />
      </div>
      <div>
        <label>Email:</label>
        <input type="email" v-model="newUserParams.email" />
      </div>
      <div>
        <label>City:</label>
        <input type="text" v-model="newUserParams.location" />
      </div>
      <div>
        <p>Are you an artist?</p>
        <form action="is_artist?">
          <input type="radio" v-model="newUserParams.is_artist" id="yes" name="is_artist?" value="true" />
          <label for="yes">Yes</label>
          <br />
          <input type="radio" v-model="newUserParams.is_artist" id="no" name="is_artist?" value="false" />
          <label for="no">No</label>
          <br />
        </form>
      </div>
      <div>
        <label>Password:</label>
        <input type="password" v-model="newUserParams.password" />
      </div>
      <div>
        <label>Password confirmation:</label>
        <input type="password" v-model="newUserParams.password_confirmation" />
      </div>
      <input type="submit" value="Submit" />
    </form>
  </div>
</template>
