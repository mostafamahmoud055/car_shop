<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="AddNewCar"
    tabindex="-1"
    aria-labelledby="AddNewCarLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="AddNewCarLabel">
            {{ this.$store.state.currentLanguage.AddNewCar.title }}
          </h1>
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
            @click="close"
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
              id="carName"
              aria-describedby="carName"
              :placeholder="this.$store.state.currentLanguage.AddNewCar.carName"
              v-model.trim="carName"
            />
            <label for="carName" class="form-label">{{
              this.$store.state.currentLanguage.AddNewCar.carName
            }}</label>
            <div class="error-feedback text-danger" v-if="v$.carName.$error">
              {{ v$.carName.$errors[0].$message }}
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
              v-model.trim="carPrice"
            />
            <label for="carPrice" class="form-label">{{
              this.$store.state.currentLanguage.AddNewCar.carPrice
            }}</label>
            <div class="error-feedback text-danger" v-if="v$.carPrice.$error">
              {{ v$.carPrice.$errors[0].$message }}
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
              v-model.trim="carModelYear"
            />
            <label for="carModelYear" class="form-label">{{
              this.$store.state.currentLanguage.AddNewCar.modelYear
            }}</label>
            <div
              class="error-feedback text-danger"
              v-if="v$.carModelYear.$error"
            >
              {{ v$.carModelYear.$errors[0].$message }}
            </div>
          </div>
          <div class="mb-3">
            <textarea
              rows="3"
              class="form-control rounded"
              id="carDetails"
              aria-describedby="carDetails"
              v-model.trim="carDetails"
            ></textarea>
            <div
              class="error-feedback text-danger mt-2"
              v-if="v$.carDetails.$error"
            >
              {{ v$.carDetails.$errors[0].$message }}
            </div>
          </div>
          <div class="mb-3">
            <input
              type="file"
              class="form-control rounded"
              id="carImage"
              aria-describedby="carImage"
              ref="carImage"
              @change="previewFiles"
            />
            <div class="error-feedback text-danger" v-if="carImageError">
              {{ carImageError }}
            </div>
          </div>
          <div>
            <img
              :src="carImage64"
              width="500"
              class="rounded d-block mx-auto"
            />
          </div>
        </div>
        <div class="modal-footer">
          <button
            id="close"
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
            @click="close"
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
            @click.prevent="addNewCar()"
          >
            {{
              this.$store.state.currentLanguage.selectedLanguage == "EN"
                ? "Add Car"
                : "إضافة سيارة"
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
  name: "AddNewCar",
  data() {
    return {
      v$: Validate(),
      carName: "",
      carPrice: "",
      carModelYear: "",
      carDetails: "",
      carImage: "",
      carImage64: "",
      carImageError: "",
    };
  },
  validations() {
    // data info must be equal to validations info
    return {
      carName: { required, minLength: minLength(3) },
      carPrice: { required, minLength: minLength(5), maxLength: maxLength(7) },
      carModelYear: {
        required,
        minLength: minLength(4),
        maxLength: maxLength(4),
      },
      carDetails: { required, minLength: minLength(100) },
    };
  },
  methods: {
    close() {
      this.v$.$reset();
      this.clearData();
    },
    clearData() {
      this.carName = "";
      this.carPrice = "";
      this.carModelYear = "";
      this.carDetails = "";
      this.carImage = "";
      this.carImage64 = "";
      this.carImageError = "";
      document.getElementById("carImage").value = "";
    },
    previewFiles(event) {
      this.carImageError = "";

      if (this.$refs.carImage.files[0]) {
        let fileInput = document.getElementById("carImage");
        let filePath = fileInput.value;
        //Allowing file type
        let allowExtensions = /(\.jpg|\.png|\.jpeg)$/i;
        if (!allowExtensions.exec(filePath)) {
          this.carImageError = "Image should be .jpg or .jpeg or .png";
          return;
        }
      }
      this.carImage = this.$refs.carImage.files[0];
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.addEventListener("load", () => {
        this.carImage64 = reader.result;
      });
    },
    async addNewCar() {
      this.v$.$validate();
      if (!this.$refs.carImage.files[0]) {
        this.carImageError = "Image is required";
        return;
      }
      if (this.carImageError) {
        return;
      }
      let fd = new FormData();
      fd.append("name", this.carName);
      fd.append("price", this.carPrice);
      fd.append("modelYear", this.carModelYear);
      fd.append("image", this.carImage);
      fd.append("details", this.carDetails);
      let result = await axios.post(`http://localhost:8000/addCar`, fd);
      if (result.status == 200) {
        console.log(result);
        $("#close").click();
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
