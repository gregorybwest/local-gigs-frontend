<script>
import axios from "axios";

export default {
  data: function () {
    return {
      user: {},
      sadStatus: "",
      current_user_id: localStorage.getItem("user_id"),
    };
  },
  created: function () {
    axios
      .get(`/users/${this.$route.params.id}`)
      .then((response) => {
        console.log("Users Show:", response.data);
        this.user = response.data;
      })
      .catch((error) => {
        this.sadStatus = error.response.status;
        this.errors = error.response.data.errors;
        console.log(this.sadStatus);
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
          this.$router.push("/events");
        });
      }
    },
  },
};
</script>

<template>
  <div class="users-show">
    <!-- body
    ======================================================================== -->
    <body>
      <!-- Main wrapper
        ==================================================================== -->
      <div id="main-wrapper">
        <!-- Main container -->
        <div id="main-container">
          <!-- Back to top button
                ============================================================ -->
          <a href="#" id="back-to-top" class="back-to-top" title="Back to top"></a>

          <!-- Header
                ============================================================ -->
          <header class="header-section header-section-fixed">
            <!-- Header section container -->
            <div class="header-section-container">
              <!-- Header menu section -->
              <div class="header-menu-section">
                <!-- Header menu section container -->
                <div class="header-menu-section-container"></div>
                <!-- /End Header menu section container -->
              </div>
              <!-- /End Header menu section -->
            </div>
            <!-- /End Header section container -->
          </header>
          <!-- /End Header section -->

          <!-- Breadcrumb section
                ============================================================ -->
          <div class="breadcrumb-section breadcrumb-section-layout-1 text-center">
            <!-- Breadcrumb container -->
            <div class="breadcrumb-section-container">
              <!-- container -->
              <div class="container gx-4">
                <!-- row -->
                <div class="row align-items-center justify-content-between">
                  <!-- User Name -->
                  <div class="breadcrumb-user name">
                    <h1 class="breadcrumb-heading h5 font-weight-500">{{ user.user_name }}</h1>
                  </div>
                  <!-- /End User Name -->
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
                <!-- Post media
                            ================================================ -->
                <div class="post-media col-lg-12">
                  <!-- Block container -->
                  <div class="post-media-container">
                    <!-- Block header -->

                    <div class="post-media-header">
                      <p style="text-align: center">
                        <img v-bind:src="user.image_url" alt="" />
                      </p>
                    </div>
                    <!-- /End Block header -->
                  </div>
                  <!-- /End Block container -->
                </div>
                <!-- /End Post media -->

                <!-- Content area
                            ================================================ -->
                <div id="primary" class="content-area col-lg-8">
                  <!-- Main -->
                  <main id="main" class="content-area-container site-main">
                    <!-- Blog wrapper -->
                    <div class="blog-block-wrapper">
                      <!-- row -->
                      <div class="row gx-36">
                        <!-- Post -->
                        <div class="blog-block-post col-lg-12">
                          <!-- Post -->
                          <article class="main-block blog-block blog-block-inner format-standard">
                            <!-- Block container -->
                            <div class="main-block-container blog-block-container blog-block-inner-container">
                              <!-- Block body -->
                              <div class="main-block-body blog-block-body blog-block-inner-body">
                                <!-- Block heading -->
                                <div class="main-block-heading blog-block-heading blog-block-inner-heading">
                                  <div v-if="user.events.length > 0">
                                    <h2 style="text-align: center">Upcoming Local Gigs:</h2>
                                    <div v-for="event in user.events" v-bind:key="event.id">
                                      <router-link v-bind:to="`/events/${event.id}`">
                                        <h3>{{ event.readable_date }} @ {{ event.yelp_venue.name }}</h3>
                                      </router-link>
                                    </div>
                                  </div>
                                </div>
                                <!-- /End Block heading -->

                                <!-- Block content -->
                                <div class="main-block-content blog-block-content blog-block-inner-content">
                                  <div>
                                    <h2>Bio:</h2>
                                    <p>{{ user.bio }}</p>
                                    <div v-if="user.spotify_link !== null">
                                      <h2>Listen!</h2>
                                      <a v-bind:href="user.spotify_link">Listen to us on Spotify!</a>
                                    </div>
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
                                <!-- /End Block content -->
                              </div>
                              <!--/End Block body -->
                            </div>
                            <!-- /End Block container -->
                          </article>
                          <!-- /End Post -->
                        </div>
                        <!-- /End Post -->
                      </div>
                      <!-- /End row -->
                    </div>
                    <!-- /End Blog wrapper -->
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
        </div>
        <!-- /End Main container -->
      </div>
      <!-- /End Main wrapper -->
    </body>
    <!-- /End body -->
    <img
      v-if="sadStatus == 404"
      v-bind:src="`https://images.squarespace-cdn.com/content/v1/51ee39dfe4b06fd80f3c7853/1401775637096-CQJRAGQQ32HR741L1BIV/image-asset.jpeg?format=1500w`"
      alt=""
    />
    <!-- <h1>{{ user.user_name }}</h1>
    <img v-bind:src="user.image_url" alt="" />
    <div v-if="user.events.length > 0">
      <h2>Upcoming Local Gigs:</h2>
      <div v-for="event in user.events" v-bind:key="event.id">
        <router-link v-bind:to="`/events/${event.id}`">
          <h3>{{ event.readable_date }} @ {{ event.yelp_venue.name }}</h3>
        </router-link>
      </div>
    </div>
    <div>
      <h2>Bio:</h2>
      <p>{{ user.bio }}</p>
      <div v-if="user.spotify_link !== null">
        <h2>Listen!</h2>
        <a v-bind:href="user.spotify_link">Listen to us on Spotify!</a>
      </div>
    </div>
    <br />
    <div v-if="current_user_id == user.id">
      <button>
        <router-link v-bind:to="`/users/${user.id}/edit`">Edit Profile</router-link>
      </button>
      <br />
      <button v-on:click="destroyUser()">Delete Account</button>
    </div> -->
  </div>
</template>

<style></style>
