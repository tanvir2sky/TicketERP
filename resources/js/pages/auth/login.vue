<template>
 <section>
    <div class="row">
    <div class="col-lg-4 m-auto">
      <v-card class="pa-5 py-5">
      
          <v-card-title class="justify-center" color="primary">Admin/Agent Login</v-card-title>
          <v-divider></v-divider>
           <v-text-field
              label="Email Address"
              solo
              append-icon="email"
              v-model="form.email" type="email" name="email">
              </v-text-field>
            <v-text-field
            solo
            :append-icon="show2 ? 'visibility_off' : 'visibility'"
            :type="show2 ? 'text' : 'password'"
            name="password"
            label="Password"
            hint="At least 8 characters"
            value="wqfasds"
            class="input-group--focused"
            @click:append="show2 = !show2"
            v-model="form.password" 
          ></v-text-field>

           <v-btn block color="primary" dark depressed large @click="login">  Login</v-btn>

          <v-divider></v-divider>
           <!-- <v-alert type="error">
              
            </v-alert> -->
                  


         
      </v-card>
    </div>
  </div>
 </section>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    show2: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')
    

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'dashboard' })
    }
  }
}
</script>
