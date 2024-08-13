<template>
  <div class="relative w-full h-screen flex items-center justify-center bg-gray-100">
    <!-- Background Image --> 
    <div class="absolute inset-0 bg-cover bg-center" :style="{ backgroundImage: `url(${backgroundImage})` }">
      <div class="absolute inset-0 bg-black opacity-30"></div> <!-- Fading Overlay -->
    </div>    
    <!-- Login Form -->
    <div class="relative w-full lg:w-1/2 max-w-md p-8 bg-white rounded-3xl shadow-lg custom-border">
      <h1 class="text-4xl font-semibold text-center">Welcome Back</h1>
      <p class="font-medium text-lg text-gray-500 text-center mt-2">Please enter your details.</p>
      <form @submit.prevent="handleLogin" class="mt-8 space-y-6 z-10 relative">
        <div class="flex flex-col">
          <label for="email" class="text-lg font-medium">Email</label>
          <input 
            v-model="email"
            type="email"
            id="email"
            class="w-full border-2 border-gray-100 rounded-xl p-4 mt-1 bg-transparent"
            placeholder="Enter your email"
            required
          />
        </div>
        <div class="flex flex-col mt-4">
          <label for="password" class="text-lg font-medium">Password</label>
          <input 
            v-model="password"
            type="password"
            id="password"
            class="w-full border-2 border-gray-100 rounded-xl p-4 mt-1 bg-transparent"
            placeholder="Enter your password"
            required
          />
        </div>
        <div class="mt-8 flex flex-col gap-y-4">
          <button
            type="submit"
            class="active:scale-[.98] active:duration-75 transition-all hover:scale-[1.01] ease-in-out transform py-4 bg-violet-500 rounded-xl text-white font-bold text-lg"
          >
            Sign in
          </button>
        </div>
        <div class="mt-8 flex justify-center items-center">
          <p class="font-medium text-base">Don't have an account?</p>
          <router-link to="/register" class="ml-2 font-medium text-base text-violet-500">Sign up</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

const backgroundImage = require('@/assets/hero-stock.png'); // Import the image

export default {
  data() {
    return {
      email: '',
      password: '',
      backgroundImage
    };
  },
  methods: {
    async handleLogin() {
  try {
    // Send login request
    const response = await axios.post('http://localhost:8000/api/login', {
      email: this.email,
      password: this.password
    });

    // Extract token from the response
    const { access_token, token_type } = response.data;
    localStorage.setItem('authToken', access_token);
    axios.defaults.headers.common['Authorization'] = `${token_type} ${access_token}`;

    // Fetch user profile
    const userProfileResponse = await axios.get('http://localhost:8000/api/user');
    const userProfile = userProfileResponse.data;

    // Store in localStorage
    localStorage.setItem('username', userProfile.name); // Store username
    localStorage.setItem('userRole', userProfile.role); // Store user role

    // Redirection based on role
    if (userProfile.role === 'admin') {
      this.$router.push('/Admin');
    } else if (userProfile.role === 'user') {
      this.$router.push('/User');
    } else {
      this.$router.push('/'); 
    }

  } catch (error) {
    console.error('Login failed:', error.response ? error.response.data.message : error.message);
    alert('Login failed: ' + (error.response ? error.response.data.message : error.message));
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
    0% 77%, 
    77% 77%, 
    77% 0%, 
    0% 0%
  );
  z-index: 0; /* Ensure the pseudo-element is behind the form */
}
</style>
