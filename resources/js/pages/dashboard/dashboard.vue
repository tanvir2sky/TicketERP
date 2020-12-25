<template>
  <section>
    <v-row>
      <v-col md="3">
        <v-card class="mx-2 d-flex justify-space-between pa-5" color="primary" dark raised>
          <div>
            <p class="mb-0 overline">New Tickets</p>
            <p class="mb-0 h3">{{ dashboardData.new_tickets }}</p>
          </div>
          <v-icon large>library_books</v-icon>
        </v-card>
      </v-col>
      <v-col md="3">
        <v-card class="mx-2 d-flex justify-space-between pa-5" color="primary" dark raised>
          <div>
            <p class="mb-0 overline">Assigned Tickets</p>
            <p class="mb-0 h3">{{ dashboardData.assigned_tickets }}</p>
          </div>
          <v-icon large>library_books</v-icon>
        </v-card>
      </v-col>
      <v-col md="3">
        <v-card class="mx-2 d-flex justify-space-between pa-5" color="primary" dark raised>
          <div>
            <p class="mb-0 overline">Closed Tickets</p>
            <p class="mb-0 h3">{{ dashboardData.closed_tickets }}</p>
          </div>
          <v-icon large>library_books</v-icon>
        </v-card>
      </v-col>
      <v-col md="3">
        <v-card class="mx-2 d-flex justify-space-between pa-5" color="primary" dark raised>
          <div>
            <p class="mb-0 overline">Today's Total Tickets</p>
            <p class="mb-0 h3">{{ dashboardData.today_total_tickets }}</p>
          </div>
          <v-icon large>library_books</v-icon>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col md="6">
        <v-card class="pa-3">
          <v-sheet class="v-sheet--offset mx-auto" color="cyan" elevation="12">
            <v-sparkline
              :labels="dashboardData.opened_graph.lables"
              :value="dashboardData.opened_graph.value"
              color="white"
              line-width="4"
              padding="16"
            ></v-sparkline>
          </v-sheet>

          <v-card-text class="pt-3">
            <div class="title font-weight-bold mb-2">Today's Ticket opened</div>
            <div class="subheading font-weight-light grey--text">Last Campaign Performance</div>
            <v-divider class="my-2"></v-divider>
            <v-icon class="mr-2" small>alarm</v-icon>
            <span class="caption grey--text font-weight-light">last registration 26 minutes ago</span>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col md="6">
        <v-card class="pa-3">
          <v-sheet class="v-sheet--offset mx-auto" color="red" elevation="12">
            <v-sparkline
              :labels="dashboardData.closed_graph.lables"
              :value="dashboardData.closed_graph.value"
              color="white"
              line-width="4"
              padding="16"
            ></v-sparkline>
          </v-sheet>

          <v-card-text class="pt-3">
            <div class="title font-weight-bold mb-2">Today's Ticket Closed</div>
            <div class="subheading font-weight-light grey--text">Last Campaign Performance</div>
            <v-divider class="my-2"></v-divider>
            <v-icon class="mr-2" small>alarm</v-icon>
            <span class="caption grey--text font-weight-light">last closed 10 minutes ago</span>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </section>
</template>
<script>
import { HTTP } from "../../axios";
export default {
  data: () => ({
    dashboardData: {
      assigned_tickets: 0,
      closed_graph: {
        labels: ["3am", "6am", "9am", "12pm", "3pm", "6pm", "9pm", "11pm"],
        value: [0, 0, 0, 0, 0, 0, 0, 0]
      },
      closed_tickets: 0,
      last_closed: "",
      last_opened: "0 hour ago",
      new_tickets: 0,
      opened_graph: {
        labels: ["3am", "6am", "9am", "12pm", "3pm", "6pm", "9pm", "11pm"],
        value: [0, 0, 0, 0, 0, 0, 0, 0]
      },
      today_total_tickets: 0
    }
  }),
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      HTTP.get(`dashboard-report`)
        .then(response => {
          // console.log(response.data);
          this.dashboardData = response.data;
          // console.log(this.dashboardData);
        })
        .catch(e => {
          // this.errors.push(e)
        });
    }
  }
};
</script>