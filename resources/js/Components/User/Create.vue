<template>
  <v-col cols="6" class="offset-4">
    <RouterLink to="/" class="v-btn v-btn--size-default v-btn--border px-4 py-2">
      Back to list
    </RouterLink>
    <v-card class="mt-2 px-2 py-2">
      <v-form @submit="handleSubmit">
        <v-text-field
            v-model="name"
            :rules="nameRules"
            label="Name"
        ></v-text-field>
        <v-text-field
            v-model="email"
            :rules="emailRules"
            label="Email"
        ></v-text-field>
        <v-btn class="mt-2 float-right" color="blue" type="submit" :disabled="isSubmitting">Submit</v-btn>
      </v-form>
    </v-card>
  </v-col>
</template>

<script>
export default {
  data: () => ({
    name: '',
    email:'',
    isSubmitting: false,
    nameRules: [
      value => {
        if (value) return true

        return 'You must enter a name.'
      },
    ],
    emailRules: [
      value => /^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value) || 'Must be a valid e-mail.'
    ],
  }),
  methods:{
    async handleSubmit (e){
      e.preventDefault();
      this.isSubmitting = true;
      try {
        const response = await axios.post('/users', {
          name: this.name,
          email: this.email,
        }, {
          headers: {
            'Accept': 'application/json'
          }
        })

        this.$router.push("/");
      }catch (e){
        console.log(e);
      }finally {
        this.isSubmitting = false
      }
    }
  }
}
</script>