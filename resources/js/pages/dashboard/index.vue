<template>
  <section>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant.sync="mini"
      permanent
      :clipped="clipped"
      app
      color="primary"
      dark
    >
     <template v-slot:prepend>
        <v-list-item two-line>
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/women/81.jpg">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{ user.first_name + ' ' +  user.last_name}}</v-list-item-title>
            <v-list-item-subtitle>{{user.role}}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </template>

      <v-divider></v-divider>
      <AdminMenu v-if="user.role === 'admin'"/>
      <AgentMenu v-if="user.role === 'agent'"/>
    </v-navigation-drawer>
    <v-app-bar
      :clipped-left="clipped"
      fixed
      app
    >
      <v-app-bar-nav-icon  @click.stop="mini = !mini"  />

      <v-toolbar-title v-text="title" />
      <v-spacer />

      <v-btn icon @click="logout">
        <v-icon>power_settings_new</v-icon>
      </v-btn>
      <v-btn icon @click.stop="rightDrawer = !rightDrawer">
        <v-icon>menu</v-icon>
      </v-btn>
    </v-app-bar>
    <v-main>
      <child />
    </v-main>
    <v-navigation-drawer
      v-model="rightDrawer"
      :right="right"
      temporary
      fixed
    >
      <v-list>
        <v-list-item @click.native="right = !right">
          <v-list-item-action>
            <v-icon light>
              mdi-repeat
            </v-icon>
          </v-list-item-action>
          <v-list-item-title>Switch drawer (click me)</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-footer
      :fixed="fixed"
      app
    >
      <span>&copy; 2019</span>
    </v-footer>
  </section>
</template>

<script>
import AdminMenu from '../../components/dashboard/AdminMenu'
import AgentMenu from '../../components/dashboard/AgentMenu'
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',
  components:{
    AdminMenu,
    AgentMenu
  },
  data () {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      mini: false,
      right: true,
      rightDrawer: false,
      title: ` `
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted(){
   this.title= `Welcome , ${this.user.first_name}`;
  },
  methods:{
    async logout(){
      // await this.$auth.logout();
      await this.$store.dispatch('auth/logout')
      this.$router.push('/login')
    },
    change(){

    }
}
}
</script>
<style lang="scss" scoped>

 .logoDiv{
   text-align: center;

  .logo{
    height: 5em;
  }
 }
 .dashboardContent{
   padding: 1em!important;
 }

</style>
