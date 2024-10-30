import { createApp } from "vue";
import { createStore } from "vuex";
import axios from "axios";
import App from "./App.vue";
import LoginForm from "./components/LoginForm.vue";
import NumberDisplay from "./components/NumberDisplay.vue";

const store = createStore({
  state: {
    user: null,
    number: null,
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setNumber(state, number) {
      state.number = number;
    },
  },
  actions: {
    async login({ commit }, { username, password }) {
      const response = await axios.post("/api/login", { username, password });
      commit("setUser", response.data.user);
    },
    async getNumber({ commit }) {
      const response = await axios.get("/api/getNumber");
      commit("setNumber", response.data.number);
    },
    async saveNumber({ commit }, number) {
      await axios.post("/api/saveNumber", { number });
      commit("setNumber", number);
    },
  },
});

const app = createApp(App);
app.use(store);
app.component("LoginForm", LoginForm);
app.component("NumberDisplay", NumberDisplay);
app.mount("#app");
