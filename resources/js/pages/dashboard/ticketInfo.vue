<template>
  <section>
    <v-card class="pa-3">
      <v-row>
        <!-- <v-col md="3">
          <v-card outlined class="ticketCard text-center pa-3">
              
              <v-select :items="statusList" v-model="status" label="Status" outlined></v-select>
              <v-divider></v-divider>
              <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-subtitle>Created At</v-list-item-subtitle>
                  <v-list-item-title>{{ticketInfo.created_at}}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-subtitle>Issuer Name</v-list-item-subtitle>
                  <v-list-item-title>{{ticketInfo.name}}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-subtitle>Issuer Email</v-list-item-subtitle>
                  <v-list-item-title>{{ticketInfo.email}}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-select :items="agentList" v-model="assignTo" label="Assign TO" outlined></v-select>
              <v-divider></v-divider>
              <v-select :items="priorityList" label="Priority" outlined v-model="priority"></v-select>
          </v-card> 
        </v-col> -->
        <v-col md="6">
          <v-card outlined class="ticketCard pa-3">
            <div>
              <p class="subtitle-2">
                <span class="overline">Ticket Number :</span>
                {{ ticketInfo.ticket_number }}
              </p>
              <v-row>
                <v-col>
                  <div>
                    <span class="overline">Status :</span>
                    <v-chip
                      class="ma-2 statusChip"
                      text-color="white"
                      :color="this.status === 'Closed' ? 'red' : 'primary'"
                      >{{ this.status }}</v-chip
                    >
                  </div>
                </v-col>
                <v-col>
                  <div>
                    <span class="overline">Priority :</span>
                    <v-chip class="ma-2 priorityChip" color="primary">{{
                      priority === null ? "Set" : priority
                    }}</v-chip>
                  </div>
                </v-col>
              </v-row>
            </div>

            <v-divider></v-divider>

            <v-list-item two-line>
              <v-list-item-content>
                <v-list-item-subtitle>Category</v-list-item-subtitle>
                <v-list-item-title>{{ ticketInfo.category }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item two-line>
              <v-list-item-content>
                <v-list-item-subtitle>Subject</v-list-item-subtitle>
                <v-list-item-title>{{ ticketInfo.subject }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item two-line>
              <v-list-item-content>
                <v-list-item-subtitle>Description</v-list-item-subtitle>
                {{ ticketInfo.body }}
              </v-list-item-content>
            </v-list-item>
            <v-list-item two-line>
              <v-list-item-content>
                <v-list-item-subtitle>File</v-list-item-subtitle>
                <div class="d-flex flex-wrap mt-3">
                <div v-for="link in urlLinks.length" :key="link" class="mr-3">
                  <a :href="urlLinks" download>
                    <v-icon>vertical_align_bottom</v-icon>
                    </a>
                </div>
                </div>

              </v-list-item-content>
            </v-list-item>
          </v-card>
        </v-col>
        <v-col md="6">
          <AppAdminTicketReply/>
        </v-col>
      </v-row>
    </v-card>
  </section>
</template>
<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { mapGetters } from "vuex";

import { HTTP } from "../../axios";

import AppAdminTicketReply from "../../components/dashboard/Ticket/AppAdminTicketReply";
export default {
  middleware: "auth",
  components: {
    AppAdminTicketReply,
  },

  data: () => ({
    assignTo: null,
    agentList: [],

    priority: null,
    priorityList: [],

    status: "Pending",
    statusList: ["Pending", "Closed", "Assigned"],
    urlLinks:[],

    ticketInfo: "",
    ticketId: "",
    ticketReply: [],
  }),
  created() {
    this.initialize();
  },
  computed: mapGetters({
    user: "auth/user",
  }),
  methods: {
    initialize() {
      console.log("The id is: " + this.$route.params.id);
      this.ticketId = this.$route.params.id;
      HTTP.get(`tickets/${this.$route.params.id}`)
        .then((response) => {
          this.ticketInfo = response.data.data;
          this.ticketReply = response.data.data.replies;
          this.urlLinks = response.data.data.file_url[0].file_url;
          // console.log(this.ticketInfo);
          console.log("url"+this.urlLists);
          console.log("length"+urlLists.length);
        })
        .catch((e) => {
          // this.errors.push(e)
        });
      HTTP.get(`users`)
        .then((response) => {
          let res = response.data.data.users;
          console.log(res);
          res.filter((item, i) => {
            this.agentList.push(item.first_name + " " + item.last_name);
          });
        })
        .catch((e) => {
          // this.errors.push(e)
        });
      HTTP.get(`priorities`)
        .then((response) => {
          let res = response.data.data.priorities;
          res.filter((item, i) => {
            this.priorityList.push(item.title);
          });
          // console.log(this.priorityList);
        })
        .catch((e) => {
          // this.errors.push(e)
        });
    },
    addToReply() {},
  },
};
</script>
<style lang="scss" scoped>

// @media only screen and (min-width: 1007px) {
// .statusChip{
// margin:0px!important;
// }
// .priorityChip{
// margin:0px!important;
// }
// }
</style>

