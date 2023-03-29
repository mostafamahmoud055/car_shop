import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "Home",
    component: function () {
      return import("../views/HomeView.vue");
    },
  },
  {
    path: "/about",
    name: "About",
    component: function () {
      return import("../views/AboutView.vue");
    },
  },
  {
    path: "/contact-us",
    name: "contact us",
    component: function () {
      return import("../views/ContactUs.vue");
    },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});
router.beforeEach((to, from, next) => {
  if (to.name == undefined) {
    router.push("/");
  } else {
    document.title = to.name;
    next();
  }
});

export default router;
