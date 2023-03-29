<template>
  <aos-vue animation="fade-up">
    <div class="row m-0" style="max-width: 100%">
      <div class="col-12 col-md-6">
        <img src="@/assets/globally_conected.png" class="img-fluid" />
      </div>
      <div
        class="col-12 col-md-6 d-flex flex-column justify-content-center"
        :class="
          this.$store.state.currentLanguage.selectedLanguage == 'EN'
            ? 'text-start'
            : 'text-end'
        "
      >
        <h1>
          {{
            this.$store.state.currentLanguage.GlobalConnection.GloballyConnected
          }}
        </h1>
        <h5>
          {{ this.$store.state.currentLanguage.GlobalConnection.listening }}
        </h5>
        <p>
          {{
            this.$store.state.currentLanguage.GlobalConnection.internet +
            "" +
            this.$store.state.currentLanguage.GlobalConnection.internet +
            "" +
            this.$store.state.currentLanguage.GlobalConnection.internet +
            "" +
            this.$store.state.currentLanguage.GlobalConnection.internet
          }}
        </p>
      </div>
    </div>
  </aos-vue>
</template>

<script>
export default {
  name: "GloballyConnected",
};
</script>

<style></style>
