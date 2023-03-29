<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Car</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body text-start">
          Are you sure you want to delete
          <span>{{ carInfo.name }}</span
          >?
        </div>
        <div class="modal-footer">
          <button
            id="closeDelete"
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button
            type="button"
            class="btn btn-primary"
            @click="deleteCar(carInfo.id)"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from "@/store";
import $ from "jquery";
import axios from "axios";
export default {
  name: "deleteCar",
  computed: {
    carInfo() {
      return store.state.carInfo;
    },
  },
  methods: {
    async deleteCar(id) {
      let result = await axios.delete(`http://localhost:8000/deleteCar/${id}`);
      // delete 200;
      if (result.status == 200) {
        console.log(result);
        $("#closeDelete").click();
        store.dispatch("allCars");
      }
    },
  },
};
</script>

<style></style>
