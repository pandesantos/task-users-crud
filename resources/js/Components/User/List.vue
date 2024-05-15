<script>
import axios from 'axios';

export default {
  name: 'List',
  data() {
    return {
      users: [],
      loading: true,
      error: null,
    };
  },
  methods: {
    async fetchUsers(page) {
      this.loading = true;
      try {
        const response = await axios.get(`/users?page=${page}`);
        this.users = response.data;
      } catch (error) {
        this.error = error.message || 'An error occurred';
      } finally {
        this.loading = false;
      }
    },
    async deleteUser(userId){
      this.loading = true;
      try {
        await axios.delete(`/users/${userId}`);
        this.users = this.users.filter(item => item.id !== userId);
      } catch (error) {
        this.error = error.message || 'An error occurred';
      } finally {
        this.loading = false;
      }
    },
  },
  created() {
    this.fetchUsers();
  },
};
</script>


<template>
  <v-banner-actions>
    <RouterLink to="/create-user">
      <v-btn variant="outlined">Add New User</v-btn>
    </RouterLink>
  </v-banner-actions>
  <v-card class="mt-4" title="List of users">
    <v-progress-linear
        v-if="loading"
        indeterminate
        color="primary"
        class="ma-auto"
    ></v-progress-linear>
    <v-alert v-else-if="error" type="error">
      {{ error }}
    </v-alert>
    <v-table v-else>
      <thead>
      <tr>
        <th class="text-left">Name</th>
        <th class="text-left">Email</th>
        <th class="text-left">Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users" :key="user.id" v-if="users.length > 0">
        <td>
          <v-avatar size="36px">
            <v-img v-if="user.avatar" :alt="user.name" :src="user.avatar"></v-img>
          </v-avatar>
          <span class="ml-3">{{ user.name }}</span>
        </td>
        <td>{{ user.email }}</td>
        <td>
          <RouterLink :to="'/edit-user/' + user.id">
            <v-btn>
              Edit
            </v-btn>
          </RouterLink>
          <v-btn color="error" class="ml-2" @click="deleteUser(user.id)">
            Delete
          </v-btn>
        </td>
      </tr>
      <tr v-else>
        <td colspan="5">No users found...</td>
      </tr>
      </tbody>
    </v-table>
  </v-card>
</template>

<style scoped>

</style>