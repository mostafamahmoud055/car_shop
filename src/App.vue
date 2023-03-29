<template>
  <div :class="this.$store.state.currentLanguage.selectedLanguage">
    <nav
      class="navbar navbar-light navbar-expand-lg"
      style="position: absolute; z-index: 3; width: 100%; top: 35px"
    >
      <div class="container">
        <router-link class="navbar-brand" style="color: #fff" to="/"
          >CAR<span style="color: #01d28e">BOOK</span></router-link
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span style="box-shadow: none; outline: none; color: #fff">
            <font-awesome-icon icon="fa-solid fa-bars" />
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li> -->
          </ul>
          <li class="nav-item">
            <router-link to="/">{{
              this.$store.state.currentLanguage.home
            }}</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/about">{{
              this.$store.state.currentLanguage.about
            }}</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/contact-us">{{
              this.$store.state.currentLanguage.contact
            }}</router-link>
          </li>
          <li class="nav-item">
            <span class="language" data-lang="" @click="changeLanguage"
              >AR</span
            >
          </li>
        </div>
      </div>
    </nav>
    <router-view />
  </div>
</template>
<script>
import translate from "@/languages/translations";
import $ from "jquery";
import store from "@/store";
export default {
  mounted() {
    if (localStorage.getItem("currentLanguage") == null) {
      $(".language").text("AR");
      $(".language").attr("data-lang", "ar");
      localStorage.setItem("currentLanguage", "en");
      store.dispatch("changeLanguageACtion", {
        lang: translate["en"],
      });
    } else {
      if (localStorage.getItem("currentLanguage") == "en") {
        $(".language").attr("data-lang", "ar");
        $(".language").text("AR");
      } else {
        $(".language").attr("data-lang", "en");
        $(".language").text("EN");
      }
      store.dispatch("changeLanguageACtion", {
        lang: translate[localStorage.getItem("currentLanguage")],
      });
    }
    store.dispatch("allCars");
    store.dispatch("randCars");
  },

  methods: {
    changeLanguage() {
      localStorage.setItem("currentLanguage", $(".language").attr("data-lang"));
      store.dispatch("changeLanguageACtion", {
        lang: translate[$(".language").attr("data-lang")],
      });
      if ($(".language").attr("data-lang") == "en") {
        $(".language").attr("data-lang", "ar");
        $(".language").text("AR");
      } else {
        $(".language").attr("data-lang", "en");
        $(".language").text("EN");
      }
    },
  },
};
</script>
<style>
li {
  list-style: none;
  padding: 0 22px;
}
li a {
  text-decoration: none !important;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

.language,
nav a {
  font-weight: bold;
  color: aliceblue;
}
.language {
  cursor: pointer;
}

.language:hover,
nav a:hover {
  color: aliceblue;
}

nav a.router-link-exact-active {
  color: #42b983;
}
.AR {
  direction: rtl;
}
.EN {
  direction: ltr;
}
/* .modal-backdrop.show {
  position: static;
} */
/* @keyframes fade-up {
  0% {
    opacity: 0;
    transform: translateY(10rem);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-up {
  animation: fade-up 1s ease forwards;
}

.delay01 {
  opacity: 0;
  animation-delay: 0.8s;
}

.delay02 {
  opacity: 0;
  animation-delay: 1s;
}

.delay03 {
  opacity: 0;
  animation-delay: 1.2s;
} */
</style>
