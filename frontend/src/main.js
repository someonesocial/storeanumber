import { createApp } from "vue";
import { createStore } from "vuex";
import axios from "axios";
import App from "./App.vue";
import LoginForm from "./components/LoginForm.vue";
import NumberDisplay from "./components/NumberDisplay.vue";

const apiBaseUrl = import.meta.env.VITE_API_URL || "/api";

// Add axios defaults for credentials
axios.defaults.withCredentials = true;

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
    clearUser(state) {
      state.user = null;
      state.number = null;
    },
  },
  actions: {
    async login({ commit }, { username, password }) {
      const response = await axios.post(`${apiBaseUrl}/login`, {
        username,
        password,
      });
      commit("setUser", response.data.user);
    },
    async register({ commit }, { username, password }) {
      await axios.post(`${apiBaseUrl}/register`, { username, password });
    },
    async logout({ commit }) {
      await axios.post(`${apiBaseUrl}/logout`);
      commit("clearUser");
    },
    async getNumber({ commit }) {
      const response = await axios.get(`${apiBaseUrl}/getNumber`);
      commit("setNumber", response.data.number);
    },
    async saveNumber({ commit }, number) {
      await axios.post(`${apiBaseUrl}/saveNumber`, { number });
      commit("setNumber", number);
    },
  },
});

const app = createApp(App);
app.use(store);
app.component("LoginForm", LoginForm);
app.component("NumberDisplay", NumberDisplay);
app.mount("#app");
