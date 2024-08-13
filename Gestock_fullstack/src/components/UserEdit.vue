<template>
    <div>
      <h2 class="text-2xl font-bold mb-4">Edit User</h2>
      <form @submit.prevent="updateUser">
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
          <input v-model="password" type="password" id="password" class="border p-2 w-full" />
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update</button>
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
    async created() {
      const userId = this.$route.params.id;
      const response = await axios.get(`http://localhost:8000/api/users/${userId}`);
      const user = response.data;
      this.name = user.name;
      this.email = user.email;
    },
    methods: {
      async updateUser() {
        try {
          const userId = this.$route.params.id;
          await axios.put(`http://localhost:8000/api/users/${userId}`, {
            name: this.name,
            email: this.email,
            password: this.password
          });
          this.$router.push('/admin/users');
        } catch (error) {
          console.error('Error updating user:', error);
        }
      }
    }
  };
  </script>
  