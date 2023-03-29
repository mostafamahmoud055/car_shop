<template>
  <AddNewCar />
  <deleteCar />
  <updateCar :car="car" />
  <infoView />
  <aos-vue animation="fade-up">
    <div class="container" style="direction: ltr !important">
      <!-- Button trigger modal -->
      <vueper-slides
        class="no-shadow"
        :visible-slides="3"
        slide-multiple
        :gap="3"
        :slide-ratio="1 / 4"
        :dragging-distance="200"
        :breakpoints="{ 800: { visibleSlides: 2, slideMultiple: 2 } }"
      >
        <vueper-slide v-for="car in allCars" :key="car.id">
          <template #content>
            <div class="card">
              <img
                :src="`/assets/img/imgPHP/${car.image}`"
                class="card-img-top card-img-h"
                alt=""
              />
              <div
                class="card-body"
                :style="
                  this.$store.state.currentLanguage.selectedLanguage == 'EN'
                    ? 'text-align:start'
                    : 'text-align:end'
                "
              >
                <h5
                  class="card-title"
                  v-if="
                    this.$store.state.currentLanguage.selectedLanguage == 'EN'
                  "
                >
                  {{ car.name }} {{ car.modelYear }}
                </h5>
                <h5 class="card-title" v-else>
                  {{ car.modelYear }} {{ car.name }}
                </h5>
                <h6>{{ convertNumToPrice(car.price) }} EGP</h6>
                <h6>{{ car.details }}</h6>
                <div
                  class="row justify-content-around"
                  :style="
                    this.$store.state.currentLanguage.selectedLanguage == 'EN'
                      ? 'direction:ltr'
                      : 'direction:rtl'
                  "
                >
                  <a
                    class="col-lg-3 col-12 btn btn-primary mt-1 p-x-1 View"
                    data-bs-toggle="modal"
                    data-bs-target="#infoModal"
                    @click="passInfo(car)"
                    >{{
                      this.$store.state.currentLanguage.selectedLanguage == "EN"
                        ? "Info"
                        : "معلومات"
                    }}</a
                  >
                  <a
                    class="col-lg-3 col-12 btn btn-primary mt-1 p-x-1 Update"
                    data-bs-toggle="modal"
                    data-bs-target="#updateCar"
                    @click="passInfoToUpdate(car)"
                    >{{
                      this.$store.state.currentLanguage.selectedLanguage == "EN"
                        ? "Update"
                        : "تحديث"
                    }}</a
                  >
                  <a
                    class="col-lg-3 col-12 btn btn-primary mt-1 p-x-1 Delete"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    @click="passInfo(car)"
                    >{{
                      this.$store.state.currentLanguage.selectedLanguage == "EN"
                        ? "Delete"
                        : "حذف"
                    }}</a
                  >

                  <input type="hidden" name="id" value="" />
                </div>
              </div>
            </div>
          </template>
        </vueper-slide>
        <vueper-slide class="text-start">
          <template #content>
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#AddNewCar"
              style="background-color: transparent !important; color: #42b983"
            >
              <font-awesome-icon icon="fa-solid fa-plus" /><br />
              {{
                this.$store.state.currentLanguage.selectedLanguage == "EN"
                  ? "New Car"
                  : "سيارة جديدة"
              }}
            </button>
          </template>
        </vueper-slide>
      </vueper-slides>
    </div>
  </aos-vue>
</template>
<script>
// import $ from "jquery";
// import axios from "axios";
import infoView from "@/components/infoView.vue";
import deleteCar from "@/components/deleteCar.vue";
import updateCar from "@/components/updateCar.vue";
import store from "@/store";
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
import AddNewCar from "@/components/AddNewCar.vue";

export default {
  components: {
    VueperSlides,
    VueperSlide,
    AddNewCar,
    infoView,
    deleteCar,
    updateCar,
  },
  name: "AllCars",
  data() {
    return {
      card: ``,
      car: ``,
    };
  },
  computed: {
    allCars() {
      store.dispatch("randCars");
      return store.state.allCars;
    },
  },
  methods: {
    passInfo(car) {
      store.commit("infoOfCar", car);
    },
    passInfoToUpdate(car) {
      this.car = car;
    },
    convertNumToPrice(num) {
      return new Intl.NumberFormat("en-EG").format(num);
    },
  },
};
</script>
<style>
.card {
  background-color: #ffffff0d;
  box-shadow: 0px 5px 12px -1px rgb(0 0 0 / 6%);
  padding: 0px;
  border-radius: 20px;
  border: none;
  color: aliceblue;
  height: fit-content;
}
.map,
.tel {
  color: aliceblue;
  text-decoration: none;
}

.btn-primary {
  background-color: #42b983 !important;
  color: #fff;
  border-color: transparent;
}
.btn-primary:hover {
  border-color: transparent !important;
}
.vueperslides__arrow {
  display: none !important;
}
.vueperslide__content-wrapper {
  background-color: #58feb3;
}
.vueperslides__parallax-wrapper {
  padding: unset;
  height: 630px;
}
.vueperslides__track-inner {
  align-items: center;
}
.card-img-h {
  height: 224px;
}
</style>
