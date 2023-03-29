<template>
  <aos-vue animation="fade-up">
    <div class="hero-wrap">
      <!-- <div class="overlay"></div> -->
      <div
        id="carouselExampleDark"
        class="carousel carousel-dark carousel-fade"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <!-- <div class="carousel-item active" data-bs-interval="30">
            <div class="overlay"></div>
            <img
              :src="`/assets/img/imgPHP/${randCars[0].image}`"
              class="d-block h-100 w-100 m-auto"
              alt=""
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>
                Some representative placeholder content for the first slide.
              </p>
            </div>
          </div> -->
          <div
            class="carousel-item"
            :class="car == randCars[0] ? 'active' : ''"
            v-for="car in randCars"
            :key="car.image"
            data-bs-interval="3000"
          >
            <div class="overlay"></div>
            <img
              :src="`/assets/img/imgPHP/${car.image}`"
              class="d-block h-100 w-100 m-auto"
              alt=""
            />
            <div class="carousel-caption d-none d-md-block">
              <h1>{{ car.name }}</h1>
              <p class="details">
                {{ car.details }}
              </p>
            </div>
          </div>
        </div>
        <!-- <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleDark"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button> -->
        <!-- <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide-to="3"
          aria-label="Slide 4"
        ></button>
      </div> -->
        <!-- <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleDark"
        data-bs-slide="next"
      >
        <span
          class="carousel-control-next-icon carousel-light"
          aria-hidden="true"
        ></span>
        <span class="visually-hidden">Next</span>
      </button> -->
      </div>
    </div>
  </aos-vue>
</template>

<script>
import store from "@/store";
export default {
  name: "headerMain",
  computed: {
    randCars() {
      console.log(store.state.randCars);
      return store.state.randCars;
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.hero-wrap,
.carousel {
  position: relative;
  width: 100%;
  min-height: 100vh;
}
.hero-wrap .overlay {
  z-index: 2;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  opacity: 0.6;
  background: #000000;
}
.swiper {
  position: relative;
  top: 20%;
}
img {
  max-height: 100vh;
}
p,
h1 {
  color: #fff !important;
  position: relative;
  z-index: 3 !important;
}
.details {
  width: 50%;
  margin: auto;
}
.carousel-control-next-icon,
.carousel-control-prev-icon {
  filter: invert(0) grayscale(100);
}
.carousel-dark .carousel-indicators [data-bs-target] {
  background-color: #fff;
}
</style>
