<template>
  <div>
    <h2>Your Number</h2>
    <p v-if="number !== null">Your stored number is: {{ number }}</p>
    <p v-else>You haven't stored a number yet.</p>
    <form @submit.prevent="handleSaveNumber">
      <label>
        Number:
        <input v-model="newNumber" type="number" required>
      </label>
      <button type="submit">Save Number</button>
    </form>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'NumberDisplay',
  data() {
    return {
      newNumber: null
    }
  },
  computed: {
    ...mapState(['number'])
  },
  created() {
    this.getNumber()
  },
  methods: {
    ...mapActions(['getNumber', 'saveNumber']),
    async handleSaveNumber() {
      await this.saveNumber(this.newNumber)
      this.newNumber = null
      // Display success message
    }
  }
}
</script>