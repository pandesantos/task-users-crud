<template>

  <v-col cols="6" class="offset-4">
    <RouterLink to="/" class="v-btn v-btn--size-default v-btn--border px-4 py-2">
      Back to list
    </RouterLink>
    <v-card class="mt-2 px-2 py-2">
      <v-form @submit="handleSubmit">
        <div class="text-center mb-3">
          <v-avatar size="45px">
            <v-img v-if="avatar" :alt="name" :src="avatar"></v-img>
          </v-avatar>
        </div>
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
        <v-btn class="mt-2" color="blue" type="submit" block :disabled="isSubmitting">Submit</v-btn>
      </v-form>
    </v-card>
  </v-col>
</template>

<script>
export default {
  data: () => ({
    id: 0,
    name: '',
    email:'',
    avatar:'',
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
        await axios.put('/users/'+ this.id, {
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
    },
    async getUser(userId){
      this.isSubmitting = true;
      try {
        const response = await axios.get(`/users/${userId}`)
        this.id = response.data.id;
        this.name = response.data.name;
        this.email = response.data.email;
        this.avatar = response.data.avatar;
      }catch (e){
        console.log(e);
      }finally {
        this.isSubmitting = false
      }
    }
  },
  created() {
    this.getUser(this.$route.params.id)
  }
}
</script>