<template>
  <div class="login-container">
    <div v-if="!showRegister">
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
        <a href="#" @click.prevent="showRegister = true">Register here</a>
      </p>
      <p v-if="error" class="error">{{ error }}</p>
    </div>

    <div v-else>
      <h2>Register</h2>
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
      showRegister: false,
      error: null
    }
  },
  computed: {
    ...mapState(['user'])
  },
  methods: {
    ...mapActions(['login', 'register']),
    async handleLogin() {
      try {
        this.error = null
        await this.login({ username: this.username, password: this.password })
      } catch (error) {
        this.error = error.response?.data?.error || 'Login failed'
      }
    },
    async handleRegister() {
      try {
        this.error = null
        await this.register({ username: this.username, password: this.password })
        this.showRegister = false
      } catch (error) {
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