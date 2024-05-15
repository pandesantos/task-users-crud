<script>
export default {

}
</script>

<template>
  <v-container>
    <router-view :key="$route.fullPath"></router-view>
  </v-container>
</template>
