<template>
  <div class="parentNums">
    <div class="overlay2"></div>
    <div
      class="container-fluid statistics row row-cols-1 row-cols-md-2 m-auto row-cols-lg-3 p-5"
    >
      <div
        class="col d-flex justify-content-center align-items-center flex-column"
      >
        <div class="number">
          <VueJsCounter
            start="0"
            end="8"
            duration="5000"
            thousand="."
            decimal=","
            delay="2000"
          ></VueJsCounter>
        </div>
        <div class="text-start statistic">
          {{
            this.$store.state.currentLanguage.selectedLanguage == "EN"
              ? `Year
          Experienced`
              : `سنوات من
          الخبرة`
          }}
        </div>
      </div>
      <div
        class="col d-flex justify-content-center align-items-center flex-column"
      >
        <div class="number">
          <VueJsCounter
            start="0"
            end="3"
            duration="4000"
            thousand="."
            decimal=","
          ></VueJsCounter>
        </div>
        <div class="text-start statistic">
          {{
            this.$store.state.currentLanguage.selectedLanguage == "EN"
              ? `Total
          Categories`
              : `مجموع الفئات`
          }}
        </div>
      </div>
      <div
        class="col d-flex justify-content-center align-items-center flex-column"
      >
        <div class="number">
          <VueJsCounter
            start="0"
            :end="this.$store.state.allCars.length"
            duration="3000"
            thousand="."
            decimal=","
          ></VueJsCounter>
        </div>
        <div class="text-start statistic">
          {{
            this.$store.state.currentLanguage.selectedLanguage == "EN"
              ? `Total
          Cars`
              : `مجموع السيارات`
          }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
import VueJsCounter from "vue-js-counter";
export default {
  name: "StatisticsComponent",
  components: {
    VueJsCounter,
  },
  mounted() {
    // let Numbers = document.querySelectorAll(".number");
    // for (let index = 0; index < Numbers.length; index++) {
    //   let start = 0;
    //   let max = null;
    //   let reset = setInterval(() => {
    //     start++;
    //     Numbers[index].innerHTML = start + "&nbsp;";
    //     max = Numbers[index].getAttribute("data-max");
    //     if (start == max) {
    //       clearInterval(reset);
    //     }
    //   }, 100);
    // }
    let end = 100;
    let BgReset = setInterval(() => {
      end--;
      $(".overlay2").css("right", `${end}` + "%");
      if (end == 0) {
        clearInterval(BgReset);
      }
    }, 15);
  },
};
</script>

<style>
.parentNums {
  position: relative;
}
.overlay2 {
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  bottom: 0;
  background-color: #58feb3;
}
.number {
  font-size: 3.7rem;
}
</style>
