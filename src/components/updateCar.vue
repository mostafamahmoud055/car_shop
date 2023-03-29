<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="updateCar"
    tabindex="-1"
    aria-labelledby="updateCarLabel"
    aria-hidden="true"
  >
    <span class="d-none">{{ carInfo }}</span>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="updateCarLabel">Update Car</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            :style="
              this.$store.state.currentLanguage.selectedLanguage == 'AR'
                ? 'margin:unset'
                : ''
            "
            @click="closeU"
          ></button>
        </div>
        <div
          class="modal-body"
          :style="
            this.$store.state.currentLanguage.selectedLanguage == 'EN'
              ? 'text-align:start'
              : 'text-align:start'
          "
        >
          <div class="mb-3 form-floating">
            <input
              type="text"
              class="form-control rounded"
              id="updateCarName"
              aria-describedby="updateCarName"
              :placeholder="this.$store.state.currentLanguage.AddNewCar.carName"
              v-model.trim="updateCarName"
            />
            <label for="updateCarName" class="form-label">{{
              this.$store.state.currentLanguage.AddNewCar.carName
            }}</label>
            <div
              class="error-feedback text-danger"
              v-if="v$.updateCarName.$error"
            >
              {{ v$.updateCarName.$errors[0].$message }}
            </div>
          </div>
          <div class="mb-3 form-floating">
            <input
              type="text"
              oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');"
              class="form-control rounded"
              id="carPrice"
              aria-describedby="carPrice"
              :placeholder="
                this.$store.state.currentLanguage.AddNewCar.carPrice
              "
              v-model.trim="updateCarPrice"
            />
            <label for="updateCarPrice" class="form-label">{{
              this.$store.state.currentLanguage.AddNewCar.carPrice
            }}</label>
            <div
              class="error-feedback text-danger"
              v-if="v$.updateCarPrice.$error"
            >
              {{ v$.updateCarPrice.$errors[0].$message }}
            </div>
          </div>
          <div class="mb-3 form-floating">
            <input
              type="number"
              class="form-control rounded"
              id="carModelYear"
              aria-describedby="carModelYear"
              :placeholder="
                this.$store.state.currentLanguage.AddNewCar.modelYear
              "
              v-model.trim="updateCarModelYear"
            />
            <label for="updateCarModelYear" class="form-label">{{
              this.$store.state.currentLanguage.AddNewCar.modelYear
            }}</label>
            <div
              class="error-feedback text-danger"
              v-if="v$.updateCarModelYear.$error"
            >
              {{ v$.updateCarModelYear.$errors[0].$message }}
            </div>
          </div>
          <div class="mb-3">
            <textarea
              rows="3"
              class="form-control rounded"
              id="updateCarDetails"
              aria-describedby="updateCarDetails"
              v-model.trim="updateCarDetails"
            ></textarea>
            <div
              class="error-feedback text-danger mt-2"
              v-if="v$.updateCarDetails.$error"
            >
              {{ v$.updateCarDetails.$errors[0].$message }}
            </div>
          </div>
          <div class="mb-3">
            <input
              type="file"
              class="form-control rounded"
              id="updateCarImage"
              aria-describedby="updateCarImage"
              ref="updateCarImage"
              @change="updatePreviewFiles"
            />
            <div class="error-feedback text-danger" v-if="updateCarImageError">
              {{ updateCarImageError }}
            </div>
          </div>
          <div>
            <img
              :src="
                updateCarImage64 == ''
                  ? '/assets/img/imgPHP/' + updateCarImage
                  : updateCarImage64
              "
              width="500"
              class="rounded d-block mx-auto"
            />
          </div>
        </div>
        <div class="modal-footer">
          <button
            id="closeU"
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
            @click="closeU"
          >
            {{
              this.$store.state.currentLanguage.selectedLanguage == "EN"
                ? "Close"
                : "غلق"
            }}
          </button>
          <button
            type="button"
            class="btn btn-primary"
            @click.prevent="updateCar()"
          >
            {{
              this.$store.state.currentLanguage.selectedLanguage == "EN"
                ? "Update Car"
                : "تعديل سيارة"
            }}
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
import Validate from "@vuelidate/core";
import { required, minLength, maxLength } from "@vuelidate/validators";
export default {
  name: "updateCar",
  props: ["car"],
  computed: {
    carInfo() {
      this.carValues(this.car);
      return this.car;
    },
  },
  data() {
    return {
      v$: Validate(),
      carId: "",
      updateCarName: "",
      updateCarPrice: "",
      updateCarModelYear: "",
      updateCarDetails: "",
      updateCarImage: "",
      newUpdateCarImage: "",
      updateCarImage64: "",
      updateCarImageError: "",
    };
  },
  validations() {
    // data info must be equal to validations info
    return {
      updateCarName: { required, minLength: minLength(3) },
      updateCarPrice: {
        required,
        minLength: minLength(5),
        maxLength: maxLength(7),
      },
      updateCarModelYear: {
        required,
        minLength: minLength(4),
        maxLength: maxLength(4),
      },
      updateCarDetails: { required, minLength: minLength(100) },
    };
  },
  methods: {
    closeU() {
      this.v$.$reset();
      this.clearData();
      this.carValues(this.car);
    },
    clearData() {
      this.updateCarImageError = "";
      document.getElementById("updateCarImage").value = "";
    },
    updatePreviewFiles(event) {
      this.updateCarImageError = "";

      if (this.$refs.updateCarImage.files[0]) {
        let fileInput = document.getElementById("updateCarImage");
        let filePath = fileInput.value;
        //Allowing file type
        let allowExtensions = /(\.jpg|\.png|\.jpeg)$/i;
        if (!allowExtensions.exec(filePath)) {
          this.updateCarImageError = "Image should be .jpg or .jpeg or .png";
          return;
        }
      }
      this.newUpdateCarImage = this.$refs.updateCarImage.files[0];
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.addEventListener("load", () => {
        this.updateCarImage64 = reader.result;
      });
    },
    carValues(car) {
      this.carId = car.id;
      this.updateCarName = car.name;
      this.updateCarPrice = car.price;
      this.updateCarDetails = car.details;
      this.updateCarModelYear = car.modelYear;
      this.updateCarImage = car.image;
      this.updateCarImage64 = "";
    },
    async updateCar() {
      this.v$.$validate();
      //   if (!this.$refs.updateCarImage.files[0]) {
      //     this.updateCarImageError = "Image is required";
      //     return;
      //   }
      if (this.updateCarImageError) {
        return;
      }
      let fdu = new FormData();
      fdu.append("id", this.carId);
      fdu.append("name", this.updateCarName);
      fdu.append("price", this.updateCarPrice);
      fdu.append("modelYear", this.updateCarModelYear);
      fdu.append("oldImage", this.updateCarImage);
      fdu.append("newImage", this.newUpdateCarImage);
      fdu.append("details", this.updateCarDetails);
      console.log(fdu);
      let result = await axios.post(`http://localhost:8000/updateCar`, fdu);
      if (result.status == 200) {
        $("#closeU").click();
        store.dispatch("allCars");
      }
    },
  },
};
</script>

<style>
.form-data-error {
  color: red;
}
.form-data-error input,
.form-data-error textarea {
  border-color: red;
}
</style>
