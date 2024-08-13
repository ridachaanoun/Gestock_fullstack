<template>
    <div>
      <h2 class="text-2xl font-bold mb-4">Create User</h2>
      <form @submit.prevent="createUser">
        <div class="mb-4">
          <label for="name" class="block text-lg">Name</label>
          <input v-model="name" type="text" id="name" class="border p-2 w-full" required />
        </div>
        <div class="mb-4">
          <label for="email" class="block text-lg">Email</label>
          <input v-model="email" type="email" id="email" class="border p-2 w-full" required />
        </div>
        <div class="mb-4">
          <label for="password" class="block text-lg">Password</label>
          <input v-model="password" type="password" id="password" class="border p-2 w-full" required />
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Create</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: ''
      };
    },
    methods: {
      async createUser() {
        try {
          await axios.post('http://localhost:8000/api/users', {
            name: this.name,
            email: this.email,
            password: this.password
          });
          this.$router.push('/admin/users');
        } catch (error) {
          console.error('Error creating user:', error);
        }
      }
    }
  };
  </script>
  