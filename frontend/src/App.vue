<template>
  <div class="app">
    <h1>storeanumber</h1>
    <LoginForm v-if="!user" />
    <NumberDisplay v-else />
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'App',
  computed: {
    ...mapState(['user'])
  }
}
</script>

<style>
.app {
  padding: 20px;
  max-width: 800px;
  margin: 0 auto;
}

h1 {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
}
</style>