<template>
  <div class="footer">
    <div
      class="container row row-cols-1 row-cols-md-2 m-auto py-5 row-cols-lg-4 g-5"
      :class="
        this.$store.state.currentLanguage.selectedLanguage == 'EN'
          ? 'text-start'
          : 'text-end'
      "
    >
      <div class="col d-flex flex-column" style="gap: 20px">
        <div>
          <a class="navbar-brand" href="#" style="color: rgb(255, 255, 255)"
            >CAR<span style="color: rgb(1, 210, 142)">BOOK</span></a
          >
        </div>
        <p>
          {{ this.$store.state.currentLanguage.footer.main }}
        </p>
        <div class="d-flex" style="gap: 43px; font-size: 2rem">
          <font-awesome-icon icon="fa-brands fa-twitter" />
          <font-awesome-icon icon="fa-brands fa-facebook" />
          <font-awesome-icon icon="fa-brands fa-instagram" />
        </div>
      </div>
      <div class="col">
        <h4>
          {{
            this.$store.state.currentLanguage.selectedLanguage == "EN"
              ? "Information"
              : "معلومات"
          }}
        </h4>
        <div class="d-flex flex-column" style="gap: 20px">
          <div>About</div>
          <div>Services</div>
          <div>Term and Conditions</div>
          <div>Best Price Guarantee</div>
          <div>Privacy & Cookies Policy</div>
        </div>
      </div>
      <div class="col">
        <h4>
          {{
            this.$store.state.currentLanguage.selectedLanguage == "EN"
              ? "Customer Support"
              : "دعم العملاء"
          }}
        </h4>
        <div class="d-flex flex-column" style="gap: 20px">
          <div>FAQ</div>
          <div>Payment Option</div>
          <div>Booking Tips</div>
          <div>How it works</div>
          <div>Contact Us</div>
        </div>
      </div>
      <div class="col">
        <h4>
          {{
            this.$store.state.currentLanguage.selectedLanguage == "EN"
              ? "Have a Questions?"
              : "هل لديك اسئلة؟"
          }}
        </h4>
        <div class="d-flex flex-column" style="gap: 20px">
          <div class="d-flex" style="gap: 10px">
            <div>
              <font-awesome-icon icon="fa-solid fa-location-dot" />
            </div>
            <p>203 Fake St. Mountain View, San Francisco, California, USA</p>
          </div>
          <div class="d-flex" style="gap: 10px">
            <div>
              <font-awesome-icon icon="fa-solid fa-phone" />
            </div>
            <p>+2 392 3929 210</p>
          </div>
          <div class="d-flex" style="gap: 10px">
            <div>
              <font-awesome-icon icon="fa-solid fa-envelope" />
            </div>
            <p>info@yourdomain.com</p>
          </div>
        </div>
      </div>
    </div>
    <p class="m-0">Copyright ©2023 All rights reserved</p>
  </div>
</template>

<script>
export default {
  name: "footerComponent",
};
</script>

<style>
.footer {
  background-color: #000;
  margin: 0;
}
.footer .col {
  color: aliceblue;
}
.footer .col > div {
  color: #808080d6;
}
</style>
