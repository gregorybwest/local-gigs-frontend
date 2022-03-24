<script>
import axios from "axios";

export default {
  data: function () {
    return {
      user: {},
      editUserParams: {}, // do we need this?
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
    <!-- Breadcrumb section
                ============================================================ -->
    <div class="breadcrumb-section breadcrumb-section-layout-1 text-center">
      <!-- Breadcrumb container -->
      <div class="breadcrumb-section-container">
        <!-- container -->
        <div class="container gx-4">
          <!-- row -->
          <div class="row align-items-center justify-content-between">
            <!-- Title -->
            <div class="breadcrumb-title">
              <h1 class="breadcrumb-heading h5 font-weight-500">Edit User</h1>
            </div>
            <!-- /End Title -->

            <!-- Breadcrumb -->
            <nav class="breadcrumb-nav">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="index.html">
                    <span>Local Gigs</span>
                  </a>
                </li>

                <li class="breadcrumb-item active"><span>Edit User</span></li>
              </ol>
            </nav>
            <!-- /End Breadcrumb -->
          </div>
          <!-- /End row -->
        </div>
        <!-- /End container -->
      </div>
      <!-- /End Breadcrumb container -->
    </div>
    <!-- /End Breadcrumb section -->

    <!-- Page body
                ============================================================ -->
    <div id="page-body" class="page-body">
      <!-- container -->
      <div class="container gx-4">
        <!-- row -->
        <div class="row main-row justify-content-center">
          <!-- Content area
                            ================================================ -->
          <div id="primary" class="content-area col-lg-12">
            <!-- Main -->
            <main id="main" class="content-area-container site-main pt-72 pb-72">
              <!-- Portfolio wrapper -->
              <div class="portfolio-block-wrapper">
                <!-- row -->
                <div class="row gx-36">
                  <!-- Grid item -->
                  <div class="portfolio-block-post col-lg-12">
                    <!-- Post -->
                    <article class="main-block portfolio-block portfolio-block-inner format-standard">
                      <!-- Block container -->
                      <div class="main-block-container portfolio-block-container portfolio-block-inner-container">
                        <!-- Block body -->
                        <div class="main-block-body portfolio-block-body portfolio-block-inner-body">
                          <!-- Block content -->
                          <div class="main-block-content portfolio-block-content portfolio-block-inner-content">
                            <!-- row -->
                            <div class="row gx-36 flex-row-reverse">
                              <!-- info -->
                              <div class="col-lg-6 info"></div>
                              <!-- /End info -->

                              <!-- description -->
                              <div class="col-lg-6 description">
                                <form v-on:submit.prevent="updateUser()">
                                  <h1>Edit User</h1>
                                  <ul>
                                    <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                                  </ul>
                                  <div class="container"></div>
                                  <!-- <p>Current user: {{ user }}</p> -->
                                  <p><img v-bind:src="user.image_url" alt="" /></p>
                                  <div>
                                    <label>Edit Image:</label>
                                    <input type="text" v-model="user.image_url" />
                                  </div>
                                  <div class="container"><br /></div>
                                  <div>
                                    <label>Edit User name:</label>
                                    <input type="text" v-model="user.user_name" />
                                  </div>
                                  <div class="container"><br /></div>
                                  <div>
                                    <label>Edit Location:</label>
                                    <input type="text" v-model="user.location" />
                                  </div>
                                  <div class="container"><br /></div>
                                  <div>
                                    <label>Edit Bio:</label>
                                    <input type="text" v-model="user.bio" />
                                  </div>
                                  <div class="container"><br /></div>
                                  <div>
                                    <label>Edit Spotify Url:</label>
                                    <input type="text" v-model="user.spotify_link" />
                                  </div>
                                  <input type="submit" value="Update" />
                                </form>

                                <br />
                                <br />
                              </div>
                              <div class="col-lg-4"></div>
                              <!-- /End description -->
                            </div>
                            <!-- /End row -->
                          </div>
                          <!-- /End Block content -->
                        </div>
                        <!--/End Block body -->
                      </div>
                      <!-- /End Block container -->
                    </article>
                    <!-- /End Post -->
                  </div>
                  <!-- /End Grid item -->
                </div>
                <!-- /End row -->
              </div>
              <!-- /End Portfolio wrapper -->
            </main>
            <!-- /End Main -->
          </div>
          <!-- /End Content area -->
        </div>
        <!-- /End row -->
      </div>
      <!-- /End container -->
    </div>
    <!-- /End Page body -->

    <!-- <form v-on:submit.prevent="updateUser()">
      <h1>Edit User</h1>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <p>Current user: {{ user }}</p> COMMENT THIS LINE OUT
      <p><img v-bind:src="user.image_url" alt="" /></p>
      <div>
        <label>Edit Image:</label>
        <input type="text" v-model="user.image_url" />
      </div>
      <div>
        <label>Edit User name:</label>
        <input type="text" v-model="user.user_name" />
      </div>
      <div>
        <label>Edit Location:</label>
        <input type="text" v-model="user.location" />
      </div>
      <div>
        <label>Edit Bio:</label>
        <input type="text" v-model="user.bio" />
      </div>
      <div>
        <label>Edit Spotify Url:</label>
        <input type="text" v-model="user.spotify_link" />
      </div>
      <input type="submit" value="Update" />
    </form> -->
  </div>
</template>

<style></style>
