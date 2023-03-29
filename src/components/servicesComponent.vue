<template>
  <aos-vue animation="fade-up">
    <div>
      <h1>{{ this.$store.state.currentLanguage.services.clientsOffer }}</h1>
      <p>{{ this.$store.state.currentLanguage.services.friendlyٍSystem }}</p>
      <div
        class="container m-auto row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5"
      >
        <div class="col hover">
          <font-awesome-icon icon="fa-solid fa-user" />&nbsp;
          <span>
            {{
              this.$store.state.currentLanguage.services.ExpertTechnicians
            }}</span
          >
          <p class="mt-2">
            {{ this.$store.state.currentLanguage.services.internet }}
          </p>
        </div>
        <div class="col hover">
          <font-awesome-icon icon="fa-solid fa-people-arrows" />&nbsp;
          <span>
            {{
              this.$store.state.currentLanguage.services.ProfessionalService
            }}</span
          >
          <p class="mt-2">
            {{ this.$store.state.currentLanguage.services.internet }}
          </p>
        </div>
        <div class="col hover">
          <font-awesome-icon icon="fa-solid fa-phone" />&nbsp;
          <span>{{
            this.$store.state.currentLanguage.services.GreatSupport
          }}</span>
          <p class="mt-2">
            {{ this.$store.state.currentLanguage.services.internet }}
          </p>
        </div>
        <div class="col hover">
          <font-awesome-icon icon="fa-solid fa-headset" />&nbsp;
          <span
            >{{ this.$store.state.currentLanguage.services.TechnicalSkills }}
          </span>
          <p class="mt-2">
            {{ this.$store.state.currentLanguage.services.internet }}
          </p>
        </div>
        <div class="col hover">
          <font-awesome-icon icon="fa-solid fa-wand-magic-sparkles" />&nbsp;
          <span>{{
            this.$store.state.currentLanguage.services.HighlyRecommended
          }}</span>
          <p class="mt-2">
            {{ this.$store.state.currentLanguage.services.internet }}
            {{ this.$store.state.currentLanguage.services.PositiveReviews }}
          </p>
        </div>
        <div class="col hover">
          <font-awesome-icon icon="fa-solid fa-comment" />&nbsp;
          <span>{{
            this.$store.state.currentLanguage.services.PositiveReviews
          }}</span>
          <p class="mt-2">
            {{ this.$store.state.currentLanguage.services.internet }}
          </p>
        </div>
      </div>
    </div>
  </aos-vue>
</template>

<script>
export default {
  name: "servicesComponent",
};
</script>

<style>
span {
  font-weight: bold;
}
.hover {
  text-align: start;
}
p {
  color: #808080d6;
}

.hover {
  padding: 30px;
  transition: all 0.3s ease 0s;
}
.hover:hover {
  box-shadow: -14.142px 14.142px 20px 0px rgb(157 157 157 / 50%);
  cursor: pointer;
  border-radius: 20px;
}
.hover:not(p):hover {
  color: #fab700;
}
</style>
