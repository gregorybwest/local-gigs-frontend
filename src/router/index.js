import { createRouter, createWebHistory } from "vue-router";
import Signup from "../views/Signup.vue";
import Login from "../views/Login.vue";
import Logout from "../views/Logout.vue";
import EventsIndex from "../views/EventsIndex.vue";
import EventsShow from "../views/EventsShow.vue";
import UsersShow from "../views/UsersShow.vue";
import EventsNew from "../views/EventsNew.vue";
import EventsEdit from "../views/EventsEdit.vue";
import UsersEdit from "../views/UsersEdit.vue";
import Mapbox from "../views/Map.vue";

const routes = [
  { path: "/signup", name: "signup", component: Signup },
  { path: "/login", name: "login", component: Login },
  { path: "/logout", name: "logout", component: Logout },
  { path: "/events", name: "EventsIndex", component: EventsIndex },
  { path: "/events/:id", name: "EventsShow", component: EventsShow },
  { path: "/users/:id", name: "UsersShow", component: UsersShow },
  { path: "/events/new", name: "EventsNew", component: EventsNew },
  { path: "/events/:id/edit", name: "EventsEdit", component: EventsEdit },
  { path: "/users/:id/edit", name: "UsersEdit", component: UsersEdit },
  { path: "/map", name: "map", component: Mapbox },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
