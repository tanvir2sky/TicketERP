<template>
  <v-data-table :headers="headers" :items="ticketList" sort-by="id" class="elevation-1">
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Ticket List</v-toolbar-title>
      </v-toolbar>
    </template>
    <template v-slot:item.ticket_number="{ item }">
      <v-chip class="ma-2" color="primary">{{item.ticket_number}}</v-chip>
    </template>
        <template v-slot:item.status="{ item }">
      <v-chip class="ma-2" color="red">{{item.status}}</v-chip>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { HTTP } from "../../axios";
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "Ticket Number", value: "ticket_number" },
      { text: "Category", value: "category" },
      { text: "Name", value: "name" },
      { text: "Priority", value: "priority" },
      { text: "Email", value: "email" },
      { text: "Created At", value: "created_at" }
    
    ],
    ticketList: [],
    agentList: ["mak", "Tanvir"],
    priorityList: ["Urgent", "Regular"],
    priority: ""
  }),

  computed: {},
  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },
  mounted() {},

  methods: {
    initialize() {
      HTTP.get(`tickets`)
        .then(response => {
          // console.log(response.data);
           this.ticketList = response.data.data.tickets.filter((item)=>{
              return item.status === "Closed";
          });
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    viewTicketDetails() {
      this.dialog = true;
    }
  }
};
</script>
<style lang="scss" scoped>
.ticketCard {
  height: 100%;
}
</style>
