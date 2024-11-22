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
  state: {
    user: null, // Current logged in user
    number: null, // User's stored number
  },
  mutations: {
    setUser: (state, user) => (state.user = user),
    setNumber: (state, number) => (state.number = number),
    clearUser: (state) => {
      state.user = null;
      state.number = null;
    },
  },
  actions: {
    // Check session
    checkAuth: async ({ commit }) => {
      try {
        const { data } = await axios.get(`${apiBaseUrl}/checkAuth`);
        if (data.user) {
          commit("setUser", data.user);
        }
      } catch (error) {
        console.log("No active session");
      }
    },

    // Handle user authentication
    login: async ({ commit }, credentials) => {
      const { data } = await axios.post(`${apiBaseUrl}/login`, credentials);
      commit("setUser", data.user);
    },

    // Register new user
    register: ({ commit }, credentials) =>
      axios.post(`${apiBaseUrl}/register`, credentials),

    // Get user's stored number and message
    getNumber: async ({ commit }) => {
      const { data } = await axios.get(`${apiBaseUrl}/getNumber`);
      commit("setNumber", data.number); // Update stored number
      return data; // Return the full data object which includes funnyMessage
    },

    // Save new number
    saveNumber: async ({ commit }, number) => {
      await axios.post(`${apiBaseUrl}/saveNumber`, { number });
      commit("setNumber", number); // Update stored number
    },

    // Log out user and clear state
    logout: async ({ commit }) => {
      await axios.post(`${apiBaseUrl}/logout`);
      commit("clearUser");
    },
  },
});

// Initialize Vue app with store
const app = createApp(App);
app.use(store);
app.component("LoginForm", LoginForm);
app.component("NumberDisplay", NumberDisplay);

// Check for existing session before mounting
store.dispatch("checkAuth").finally(() => {
  app.mount("#app");
});
