<template>
    <div>
      <h2>Login</h2>
      <form @submit.prevent="handleLogin">
        <label>
          Username:
          <input v-model="username" required>
        </label>
        <label>
          Password:
          <input v-model="password" type="password" required>
        </label>
        <button type="submit">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'vuex'
  
  export default {
    name: 'LoginForm',
    data() {
      return {
        username: '',
        password: ''
      }
    },
    methods: {
      ...mapActions(['login']),
      async handleLogin() {
        await this.login({ username: this.username, password: this.password })
        // Redirect or display success message
      }
    }
  }
  </script>