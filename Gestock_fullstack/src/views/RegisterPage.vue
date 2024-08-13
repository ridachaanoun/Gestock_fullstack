<template>
  <div class="relative w-full h-screen flex items-center justify-center bg-gray-100">
    <!-- Background Image --> 
    <div class="absolute inset-0 bg-cover bg-center" :style="{ backgroundImage: `url(${backgroundImage})` }">
      <div class="absolute inset-0 bg-black opacity-30"></div> <!-- Fading Overlay -->
    </div>    
    <!-- Registration Form -->
    <div class="relative w-full lg:w-1/3 max-w-md p-6 bg-white rounded-3xl shadow-lg custom-border">
      <h1 class="text-3xl font-semibold text-center mb-4">Register</h1>
      <form @submit.prevent="handleRegister" class="space-y-4 z-10 relative">
        <div class="flex flex-col">
          <label for="name" class="text-base font-medium">Name</label>
          <input 
            v-model="name"
            type="text"
            id="name"
            class="w-full border-2 border-gray-200 rounded-lg p-3 mt-1 bg-transparent"
            placeholder="Enter your name"
            required
          />
        </div>
        <div class="flex flex-col">
          <label for="email" class="text-base font-medium">Email</label>
          <input 
            v-model="email"
            type="email"
            id="email"
            class="w-full border-2 border-gray-200 rounded-lg p-3 mt-1 bg-transparent"
            placeholder="Enter your email"
            required
          />
        </div>
        <div class="flex flex-col">
          <label for="password" class="text-base font-medium">Password</label>
          <input 
            v-model="password"
            type="password"
            id="password"
            class="w-full border-2 border-gray-200 rounded-lg p-3 mt-1 bg-transparent"
            placeholder="Enter your password"
            required
          />
        </div>
        <div class="flex flex-col">
          <label for="password_confirmation" class="text-base font-medium">Confirm Password</label>
          <input 
            v-model="password_confirmation"
            type="password"
            id="password_confirmation"
            class="w-full border-2 border-gray-200 rounded-lg p-3 mt-1 bg-transparent"
            placeholder="Confirm your password"
            required
          />
        </div>
        <div class="mt-6">
          <button
            type="submit"
            class="w-full py-2 bg-indigo-600 text-white rounded-lg shadow-sm hover:bg-indigo-700 transition ease-in-out duration-150"
          >
            Register
          </button>
        </div>
        <div class="mt-4 text-center">
          <p class="text-base">Already have an account? <router-link to="/" class="text-indigo-600">Login here</router-link></p>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

const backgroundImage = require('@/assets/hero-stock.png'); 

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      backgroundImage
    };
  },
  methods: {
    ...mapActions(['register']),
    async handleRegister() {
      try {
        if (this.password !== this.password_confirmation) {
          alert('Passwords do not match.');
          return;
        }
        await this.register({ 
          name: this.name, 
          email: this.email, 
          password: this.password, 
          password_confirmation: this.password_confirmation 
        });
        this.$router.push('/'); 
      } catch (error) {
        alert('Registration failed: ' + error.message);
      }
    }
  }
};
</script>

<style scoped>
.bg-cover {
  background-size: cover;
}
.bg-center {
  background-position: center;
}
.custom-border {
  position: relative;
  overflow: hidden; 
}

.custom-border::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 4px solid rgb(139, 92, 246);
  border-radius: 1.5rem; 
  box-sizing: border-box; 
  clip-path: polygon(
    0% 0%, 
    77% 0%, 
    77% 77%, 
    0% 77%, 
    0% 0%
  );
  z-index: 0; 
}
</style>
