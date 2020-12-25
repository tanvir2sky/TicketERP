<template>
  <section>
    <v-card class="pa-3" >
      <v-tabs grow  background-color="primary">
        <v-tab>Pending / Assigned Tickets</v-tab>
        <v-tab>Closed Tickets</v-tab>
      

        <v-tab-item>
         <PendingTickets/>
        </v-tab-item>
        
        <v-tab-item>
         <AdminClosedTickets/>
        </v-tab-item>
       
      </v-tabs>
    </v-card>
  </section>
</template>
<script>
import PendingTickets from '../../components/dashboard/PendingTickets'
import AdminClosedTickets from '../../components/dashboard/AdminClosedTickets'
export default {
  components:{
    PendingTickets,
    AdminClosedTickets

  }
}
</script>