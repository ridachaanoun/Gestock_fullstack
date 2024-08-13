<template>
  <div class="admin-dashboard flex">
    <Sidebar :username="username" @view="view = $event" />
    <div class="content flex-1">
      <Navbar />
      <div class="p-4">
        <!-- Conditionally render the UserList component based on the view state -->
        <UserList v-if="view === 'users'" :users="users" />
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from '@/components/PageSidebar.vue';
import Navbar from '@/components/PageNavbar.vue';
import UserList from '@/components/UserList.vue';
import axios from 'axios';

export default {
  components: {
    Sidebar,
    Navbar,
    UserList
  },
  data() {
    return {
      username: localStorage.getItem('username') || 'Admin',
      view: 'users', // Default view to 'users'
      users: [] // To store user data
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('http://localhost:8000/api/users', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('authToken')}`
          }
        });
        this.users = response.data;
      } catch (error) {
        console.error('Failed to fetch users:', error);
      }
    }
  }
};
</script>

<style scoped>
.admin-dashboard {
  display: flex;
}
.content {
  flex: 1;
  display: flex;
  flex-direction: column;
}
</style>
