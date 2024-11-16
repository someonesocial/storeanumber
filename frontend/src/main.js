import { createApp } from "vue";
import { createStore } from "vuex";
import axios from "axios";
import App from "./App.vue";
import LoginForm from "./components/LoginForm.vue";
import NumberDisplay from "./components/NumberDisplay.vue";

const apiBaseUrl = import.meta.env.VITE_API_URL || "/api";

// Add axios defaults for credentials
axios.defaults.withCredentials = true;

// Store setup
const store = createStore({
  state: { user: null, number: null },
  mutations: {
    setUser: (state, user) => (state.user = user),
    setNumber: (state, number) => (state.number = number),
    clearUser: (state) => {
      state.user = null;
      state.number = null;
    },
  },
  actions: {
    login: async ({ commit }, credentials) => {
      const { data } = await axios.post(`${apiBaseUrl}/login`, credentials);
      commit("setUser", data.user);
    },
    register: ({ commit }, credentials) =>
      axios.post(`${apiBaseUrl}/register`, credentials),
    getNumber: async ({ commit }) => {
      const { data } = await axios.get(`${apiBaseUrl}/getNumber`);
      commit("setNumber", data.number);
      return data; // Return the full data object which includes funnyMessage
    },
    saveNumber: async ({ commit }, number) => {
      await axios.post(`${apiBaseUrl}/saveNumber`, { number });
      commit("setNumber", number);
    },
    logout: async ({ commit }) => {
      await axios.post(`${apiBaseUrl}/logout`);
      commit("clearUser");
    },
  },
});

const app = createApp(App);
app.use(store);
app.component("LoginForm", LoginForm);
app.component("NumberDisplay", NumberDisplay);
app.mount("#app");
