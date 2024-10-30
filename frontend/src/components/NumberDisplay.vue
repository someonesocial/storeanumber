<template>
  <div v-if="user" class="number-container">
    <h2>Your Number</h2>
    <div v-if="number !== null" class="current-number">
      <p>Your stored number is: {{ number }}</p>
      <button @click="showEditForm = true" class="button">Edit Number</button>
    </div>
    <p v-else>You haven't stored a number yet.</p>

    <form v-if="showEditForm || number === null" @submit.prevent="handleSaveNumber" class="form">
      <div class="form-group">
        <label>Enter a number:</label>
        <input v-model.number="newNumber" type="number" required class="input">
      </div>
      <button type="submit" class="button">Save Number</button>
      <button v-if="showEditForm" @click="cancelEdit" class="button cancel">Cancel</button>
    </form>

    <p v-if="error" class="error">{{ error }}</p>
    <p v-if="success" class="success">{{ success }}</p>

    <button @click="handleLogout" class="button logout">Logout</button>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'NumberDisplay',
  data() {
    return {
      newNumber: null,
      showEditForm: false,
      error: null,
      success: null
    }
  },
  computed: {
    ...mapState(['user', 'number'])
  },
  created() {
    if (this.user) {
      this.getNumber()
    }
  },
  methods: {
    ...mapActions(['getNumber', 'saveNumber', 'logout']),
    async handleSaveNumber() {
      try {
        this.error = null
        await this.saveNumber(this.newNumber)
        this.success = 'Number saved successfully!'
        this.showEditForm = false
        this.newNumber = null
        setTimeout(() => {
          this.success = null
        }, 3000)
      } catch (error) {
        this.error = error.response?.data?.error || 'Failed to save number'
      }
    },
    cancelEdit() {
      this.showEditForm = false
      this.newNumber = null
    },
    async handleLogout() {
      await this.logout()
    }
  }
}
</script>

<style scoped>
.number-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
}

.current-number {
  margin-bottom: 20px;
}

.form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-top: 20px;
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

.button.cancel {
  background-color: #f44336;
}

.button.cancel:hover {
  background-color: #da190b;
}

.button.logout {
  background-color: #808080;
  margin-top: 20px;
}

.error {
  color: red;
  margin-top: 10px;
}

.success {
  color: green;
  margin-top: 10px;
}
</style>