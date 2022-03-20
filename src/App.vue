<script>
export default {
  data: function () {
    return {
      isLoggedIn: !!localStorage.jwt,
      flashMessage: null,
      current_user_id: "", // this is so we can call current_user_id in the watch function below
    };
  },
  watch: {
    $route: function () {
      this.isLoggedIn = !!localStorage.jwt;
      this.flashMessage = localStorage.flashMessage;
      localStorage.removeItem("flashMessage");
      this.current_user_id = localStorage.getItem("user_id"); // so we can use `/users/${current_user_id}` in router-link to route to UsersShow page of user who is currently logged in
    },
  },
};
</script>

<template>
  <!-- Header
                ============================================================ -->
  <header class="header-section header-section-fixed">
    <!-- Header section container -->
    <div class="header-section-container">
      <!-- Header menu section -->
      <div class="header-menu-section">
        <!-- Header menu section container -->
        <div class="header-menu-section-container">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg">
            <!-- container -->
            <div class="container gx-4">
              <!-- Logo -->
              <a class="navbar-brand" href="index.html" title="Bason">
                <img src="assets/images/logo.png" alt="Bason" class="normal" />
                <img src="assets/images/logo-light.png" alt="Bason" class="transparent" />
              </a>
              <!-- /End Logo -->

              <!-- Toggler button -->
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mobile-menu"
                aria-controls="mobile-menu"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-wd">MENU</span>
                <span class="navbar-toggler-lines-wrapper">
                  <i class="navbar-toggler-line navbar-toggler-line-top"></i>
                  <i class="navbar-toggler-line navbar-toggler-line-middle"></i>
                  <i class="navbar-toggler-line navbar-toggler-line-bottom"></i>
                </span>
              </button>
              <!-- /End Toggler button -->

              <!-- Header menu (Desktop) -->
              <div class="header-menu desktop-menu navbar-collapse">
                <!-- Header menu links -->
                <ul class="navbar-nav ms-auto">
                  <!-- EVENTS INDEX -->
                  <li class="nav-item">
                    <router-link class="nav-link" to="/events"><span>EVENTS</span></router-link>
                  </li>

                  <!-- NEW EVENT -->
                  <li class="nav-item">
                    <router-link v-if="isLoggedIn" class="nav-link" to="/events/new">
                      <span>NEW EVENT</span>
                    </router-link>
                  </li>

                  <!-- PROFILE -->
                  <li class="nav-item">
                    <router-link class="nav-link" v-if="isLoggedIn" v-bind:to="`/users/${current_user_id}`">
                      <span>PROFILE</span>
                    </router-link>
                  </li>

                  <!-- LOGIN -->
                  <li class="nav-item">
                    <router-link v-if="!isLoggedIn" class="nav-link" to="/login"><span>LOGIN</span></router-link>
                  </li>

                  <!-- LOGOUT -->
                  <li class="nav-item">
                    <router-link v-if="isLoggedIn" class="nav-link" to="/logout"><span>LOGOUT</span></router-link>
                  </li>

                  <!-- SIGNUP -->
                  <li class="nav-item">
                    <router-link class="nav-link" v-if="!isLoggedIn" to="/signup"><span>SIGNUP</span></router-link>
                  </li>
                </ul>
                <!-- /End Header menu links -->

                <!-- Header menu buttons -->
                <ul class="header-menu-buttons">
                  <!-- Divider -->
                  <li class="nav-item header-menu-buttons-divider"></li>
                </ul>
                <!-- /End Header buttons -->
              </div>
              <!-- /End Header menu (Desktop) -->
            </div>
            <!-- /End container -->

            <!-- Header menu (Mobile) -->
            <div class="header-menu mobile-menu collapse" id="mobile-menu"></div>
            <!-- /End Header menu (Mobile) -->
          </nav>
          <!-- /End Navbar -->
        </div>
        <!-- /End Header menu section container -->
      </div>
      <!-- /End Header menu section -->
    </div>
    <!-- /End Header section container -->
  </header>
  <!-- /End Header section -->
  <!-- <div id="nav">
    <router-link v-if="!isLoggedIn" to="/signup">Signup</router-link>
    |
    <router-link v-if="!isLoggedIn" to="/login">Login</router-link>
    |
    <router-link v-if="isLoggedIn" to="/logout">Logout</router-link>
    |
    <router-link to="/events">All Events</router-link>
    |
    <router-link v-if="isLoggedIn" to="/events/new">New Event</router-link>
    |
    <router-link v-if="isLoggedIn" v-bind:to="`/users/${current_user_id}`">Profile</router-link>
  </div> -->

  <div v-if="flashMessage">
    {{ flashMessage }}
    <button v-on:click="flashMessage = ''">Dismiss</button>
  </div>

  <router-view />
  <!-- Footer
                ============================================================ -->
  <footer id="colophon" class="footer-section site-footer">
    <!-- footer container -->
    <div class="footer-section-container">
      <!-- footer copyright -->
      <div class="footer-section-copyright">
        <!-- Section -->
        <div class="main-section">
          <!-- container -->
          <div class="container gx-4">
            <!-- row -->
            <div class="row gx-36 align-items-center">
              <!-- col-lg-6 -->
              <div class="col-lg-6">
                <!-- Content -->
                <div class="footer-section-copyright-content light-color text-center text-lg-start">
                  <p>
                    &copy;
                    <span class="current-year">2022</span>
                    designed &amp; developed by
                    <a href="#" title="Graphicfort">Greg West</a>
                    , all rights reserved.
                  </p>
                </div>
                <!-- /End Content -->
              </div>
              <!-- /End col-lg-6 -->

              <!-- col-lg-6 -->
              <div class="col-lg-6">
                <!-- Content -->
                <div class="footer-section-copyright-content light-color text-center text-lg-end">
                  <!-- Social networks -->
                  <div
                    class="social-networks social-networks-xs social-networks-layout-1 social-networks-layout-transparent"
                  >
                    <ul>
                      <li>
                        <a href="#" title="Facebook">
                          <i class="fab fa-facebook-f"></i>
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>

                      <li>
                        <a href="#" title="Twitter">
                          <i class="fab fa-twitter"></i>
                          <i class="fab fa-twitter"></i>
                        </a>
                      </li>

                      <li>
                        <a href="#" title="youtube">
                          <i class="fab fa-youtube"></i>
                          <i class="fab fa-youtube"></i>
                        </a>
                      </li>

                      <li>
                        <a href="#" title="Behance">
                          <i class="fab fa-behance"></i>
                          <i class="fab fa-behance"></i>
                        </a>
                      </li>

                      <li>
                        <a href="#" title="Dribbble">
                          <i class="fab fa-dribbble"></i>
                          <i class="fab fa-dribbble"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!-- /End Social networks -->
                </div>
                <!-- /End Content -->
              </div>
              <!-- /End col-lg-6 -->
            </div>
            <!-- /End row -->
          </div>
          <!-- /End container -->
        </div>
        <!-- /End Section -->
      </div>
      <!-- /End footer copyright -->
    </div>
    <!-- /End footer container -->
  </footer>
  <!-- /End footer -->
</template>
