<template>
  <div class="login-container">
    <div v-if="!showRegister">
      <!-- Login form -->
      <h2>Login</h2>
      <form @submit.prevent="handleLogin" class="form">
        <div class="form-group">
          <label>Username:</label>
          <input v-model="username" required class="input">
        </div>
        <div class="form-group">
          <label>Password:</label>
          <input v-model="password" type="password" class="input">
        </div>
        <button type="submit" class="button">Login</button>
      </form>
      <p>
        Don't have an account? 
        <!-- Toggle to registration view -->
        <a href="#" @click.prevent="showRegister = true">Register here</a>
      </p>
      <p v-if="error" class="error">{{ error }}</p>
    </div>
    <div v-else>
      <h2>Register</h2>
      <!-- Registration form -->
      <form @submit.prevent="handleRegister" class="form">
        <div class="form-group">
          <label>Username:</label>
          <input v-model="username" required class="input">
        </div>
        <div class="form-group">
          <label>Password:</label>
          <input v-model="password" type="password" class="input">
        </div>
        <button type="submit" class="button">Register</button>
      </form>
      <p>
        Already have an account? 
        <!-- Toggle back to login view -->
        <a href="#" @click.prevent="showRegister = false">Login here</a>
      </p>
      <p v-if="error" class="error">{{ error }}</p>
    </div>
  </div>
</template>
<script>
import { mapActions, mapState } from 'vuex'
export default {
  name: 'LoginForm',
  data() {
    return {
      username: '',
      password: '',
      showRegister: false, // Toggle between login/register forms
      error: null
    }
  },
  computed: {
    // Map user from Vuex store
    ...mapState(['user'])
  },
  methods: {
    // Import Vuex actions for authentication
    ...mapActions(['login', 'register']),

    // Handle login form submission
    async handleLogin() {
      try {
        this.error = null
        // Call Vuex login action with form data
        await this.login({ username: this.username, password: this.password })
      } catch (error) {
        // Display error from API or fallback message
        this.error = error.response?.data?.error || 'Login failed'
      }
    },

    // Handle registration form submission 
    async handleRegister() {
      try {
        this.error = null
        // Call Vuex register action with form data
        await this.register({ username: this.username, password: this.password })
        // Switch back to login view on success
        this.showRegister = false
      } catch (error) {
        // Display error from API or fallback message
        this.error = error.response?.data?.error || 'Registration failed'
      }
    }
  }
}
</script>
<style scoped>
.login-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
}
.form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
.input {
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
}
.button {
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.button:hover {
  background-color: #45a049;
}
.error {
  color: red;
  margin-top: 10px;
}
</style>