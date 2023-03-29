<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="infoModal"
    tabindex="-1"
    aria-labelledby="infoModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="infoModalLabel">
            {{ carInfo.name }}
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body text-start">
          <img
            :src="
              `/assets/img/imgPHP/${carInfo.image}` !=
              `/assets/img/imgPHP/undefined`
                ? `/assets/img/imgPHP/${carInfo.image}`
                : ''
            "
            alt=""
          />
          <br />
          <h5 class="mt-2">Model Year: {{ carInfo.modelYear }}</h5>
          <h5>Price: {{ convertNumToPrice(carInfo.price) }} EGP</h5>
          <h6>Price: {{ carInfo.details }}</h6>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from "@/store";
export default {
  name: "infoView",
  computed: {
    carInfo() {
      return store.state.carInfo;
    },
  },
  methods: {
    convertNumToPrice(num) {
      return new Intl.NumberFormat("en-EG").format(num);
    },
  },
};
</script>

<style></style>
