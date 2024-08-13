<template>
  <div class="sidebar bg-gray-800 text-white w-64 h-screen flex flex-col">
    <div class="sidebar-header p-4 border-b border-gray-700">
      <h1 class="text-lg font-bold">{{ username }}</h1>
    </div>
    <nav class="flex-1 p-4">
      <ul>
        <li>
          <a @click="changeView('users')" class="block py-2 px-4 hover:bg-gray-700 rounded">Users</a>
        </li>
        <!-- Add more navigation links as needed -->
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  props: ['username'],
  methods: {
    changeView(view) {
      this.$emit('view', view);
    }
  }
};
</script>

<style scoped>
.sidebar {
  min-width: 16rem; /* Adjust as needed */
}
</style>
