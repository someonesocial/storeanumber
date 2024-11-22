<template>
  <div v-if="user" class="number-container">
    <!-- Display current number or prompt for new one -->
    <h2>Your Number</h2>
    <div v-if="number !== null" class="current-number">
      <p>Your stored number is: {{ number }}</p>
      <p v-if="funnyMessage" class="funny-message">{{ funnyMessage }}</p>
      <button @click="showEditForm = true" class="button">Edit Number</button>
    </div>
    <p v-else>You haven't stored a number yet.</p>

    <!-- Number input form -->
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
      success: null,
      funnyMessage: null
    }
  },
  // Map user and number from Vuex store
  computed: {
    ...mapState(['user', 'number'])
  },
  // Load number on component creation
  async created() {
    if (this.user) {
      const response = await this.getNumber();
      this.funnyMessage = response.funnyMessage;
    }
  },
  methods: {
    // Import Vuex actions
    ...mapActions(['getNumber', 'saveNumber', 'logout']),

    // Handle saving a new number
    async handleSaveNumber() {
      try {
        this.error = null;
        // Save number to backend
        await this.saveNumber(this.newNumber);

        // Get updated number and message
        const response = await this.getNumber();
        this.funnyMessage = response.funnyMessage;

        // Reset form state
        this.success = 'Number saved successfully!';
        this.showEditForm = false;
        this.newNumber = null;
        // Clear success message after 3s
        setTimeout(() => {
          this.success = null;
        }, 3000);
      } catch (error) {
        console.error('Save error:', error);
        this.error = error.response?.data?.error || 'Failed to save number';
      }
    },

    // Cancel number editing
    cancelEdit() {
      this.showEditForm = false
      this.newNumber = null
    },

    // Handle user logout
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

.funny-message {
  color: #666;
  font-style: italic;
  margin: 10px 0;
  padding: 10px;
  background-color: #f8f8f8;
  border-radius: 4px;
  border-left: 3px solid #4CAF50;
}
</style>