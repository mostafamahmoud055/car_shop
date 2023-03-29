import { createStore } from "vuex";
import axios from "axios";

export default createStore({
  state: {
    currentLanguage: {},
    allCars: {},
    randCars: "",
    carInfo: "",
  },
  getters: {},
  mutations: {
    changeLanguage(state, lang) {
      state.currentLanguage = lang;
    },
    async cars(state) {
      let result = await axios.get(`http://localhost:8000/`);
      if (result.status == 200) {
        state.allCars = result.data;
      }
    },
    async randCars(state) {
      let result = await axios.get(`http://localhost:8000/randCars`);
      if (result.status == 200) {
        state.randCars = result.data;
      }
    },
    infoOfCar(state, info) {
      state.carInfo = info;
    },
  },
  actions: {
    changeLanguageACtion(context, payload) {
      context.commit("changeLanguage", payload.lang);
    },
    allCars(context) {
      context.commit("cars");
    },
    randCars(context) {
      context.commit("randCars");
    },
  },
  modules: {},
});
