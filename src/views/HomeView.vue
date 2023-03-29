<template>
  <div class="home">
    <HeaderMain />
    <br />
    <br />
    <servicesComponent />
    <br />
    <br />
    <GloballyConnected />
    <br />
    <br />
    <AllCars />
    <br />
    <StatisticsComponent />
    <footerComponent />
  </div>
</template>

<script>
// @ is an alias to /src
import HeaderMain from "@/components/headerMain.vue";
import servicesComponent from "@/components/servicesComponent.vue";
import GloballyConnected from "@/components/GloballyConnected.vue";
import StatisticsComponent from "@/components/StatisticsComponent.vue";
import footerComponent from "@/components/footerComponent.vue";
import AllCars from "@/components/AllCars.vue";

export default {
  name: "homeView",
  components: {
    HeaderMain,
    servicesComponent,
    GloballyConnected,
    StatisticsComponent,
    footerComponent,
    AllCars,
  },
};
</script>
