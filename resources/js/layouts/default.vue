<template>

  <v-app>
    <child />
  </v-app>

</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
    
  }
}
</script>
