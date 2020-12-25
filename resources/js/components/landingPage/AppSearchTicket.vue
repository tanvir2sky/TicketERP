<template>
  <div class="containerImage">
    <div class="container">
      <div class="formCenter">
        <v-row v-if="!searchTicketSuccess">
          <v-col
            class="align-items-center justify-content-center col-lg-12 col-md-12 col-sm-12"
          >
            <v-card class="pa-5 px-5">
              <v-card-title class="justify-center p-0 mb-2 cardTitle"
                >Search Ticket</v-card-title
              >
              <v-alert v-if="dataNotFound" type="error">
                Please Enter your {{ errorMessage }}
              </v-alert>
              <v-row style="height: 290px">
                <v-col cols="12" style="max-height: 45px">
                  <v-text-field
                    v-model="ticket_number"
                    solo
                    label="Enter Ticket Number"
                    prepend-inner-icon="search"
                    class="inputField"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" class="mt-n10" style="max-height: 45px">
                  <v-text-field
                    v-model="email"
                    solo
                    label="Enter Email"
                    prepend-inner-icon="email"
                    class="inputField"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" class="mt-n10" style="max-height: 45px">
                  <v-btn
                    class="mr-4"
                    large
                    block
                    color="primary"
                    @click="searchTicket"
                    >Search
                  </v-btn>
                </v-col>
              </v-row>
            </v-card>
          </v-col>
        </v-row>
      </div>
      <v-container fluid>
        <v-row class="content-center">
          <v-col class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
          <v-card v-if="searchTicketSuccess"
            class="pa-5 px-5"
            style="height: auto">
            <div>
              <p class="subtitle-2 ma-0 position-relative">
                <span class="overline">Ticket Number :</span>
                {{searchTicketInfo.ticket_number}}
              </p>
              <v-list-item-content class="pa-0">
                <div class="tokenSubtitle">
                <v-list-item-subtitle class="tokenSubtitle-1">Created At</v-list-item-subtitle>
                <v-list-item-subtitle  class="tokenSubtitle-2">{{searchTicketInfo.created_at}}</v-list-item-subtitle>
                </div>
              </v-list-item-content>
            <v-divider class="mt-10 mb-0"></v-divider>
              <v-row>
                <v-col>
                  <div>
                    <span class="overline">Status :</span>
                    <v-chip class="ma-2" text-color="white" :color="searchTicketInfo.status === 'Closed' ? 'red':'primary' ">{{searchTicketInfo.status}}</v-chip>
                  </div>
                </v-col>
              </v-row>
            </div>

            <v-divider></v-divider>

            <v-list-item two-line class="pa-0">
              <v-list-item-content>
                <v-list-item-subtitle>Name</v-list-item-subtitle>
                <v-list-item-title>{{searchTicketInfo.name}}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item two-line class="pa-0">
              <v-list-item-content>
                <v-list-item-subtitle>Email</v-list-item-subtitle>
                <v-list-item-title>{{searchTicketInfo.email}}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item two-line class="pa-0">
              <v-list-item-content>
                <v-list-item-subtitle>Mobile</v-list-item-subtitle>
                {{searchTicketInfo.mobile}}
              </v-list-item-content>
            </v-list-item>
    
          </v-card>
        </v-col>
           <v-col v-if="searchTicketSuccess">
          <AppUserTicketReply :data ="searchTicketInfo.replies" :ticketId="searchTicketInfo.ticket_number"/>
        </v-col>  
            <!-- <v-list two-line>
              <v-list-item dark :class="{green:!attached, red:attached}">
                <v-list-item-icon>
                  <v-icon color="white"> pending </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title>{{tickets.status}}</v-list-item-title>
                  <v-list-item-subtitle>Status</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-icon>
                  <v-icon>message</v-icon>
                </v-list-item-icon>
              </v-list-item>
              <v-divider inset></v-divider>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon color="indigo"> contacts </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title>{{tickets.ticket_number}}</v-list-item-title>
                  <v-list-item-subtitle>Token Number</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-icon>
                  <v-icon>mdi-message-text</v-icon>
                </v-list-item-icon>
              </v-list-item>
              <v-divider inset></v-divider>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon color="indigo"> person </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title>{{tickets.name}}</v-list-item-title>
                  <v-list-item-subtitle>Name</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-icon>
                  <v-icon>mdi-message-text</v-icon>
                </v-list-item-icon>
              </v-list-item>
              <v-divider inset></v-divider>

              <v-list-item>
                <v-list-item-icon>
                  <v-icon color="indigo"> email </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title>testemail@gmail.com</v-list-item-title>
                  <v-list-item-subtitle>Email</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider inset></v-divider>

              <v-list-item>
                <v-list-item-icon>
                  <v-icon color="indigo"> phone </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title>0184-00-997-64</v-list-item-title>
                  <v-list-item-subtitle>Mobile</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-divider inset></v-divider>

              <v-list-item>
                <v-list-item-icon>
                  <v-icon color="indigo"> access_time </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title>12-22-2020</v-list-item-title>
                  <v-list-item-subtitle>Created At</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-list> -->
        </v-row>
        </v-container>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { HTTPWT } from "../../axios";
import AppUserTicketReply from '../../components/dashboard/Ticket/AppUserTicketReply'
export default {
  data() {
    return {
      items: [],
      tickets: null,
      searchItems: [],
      searchTicketInfo: "",
      ticket_number: null,
      email: null,
      errorMessage: null,
      searchTicketSuccess: false,
      dataNotFound: false,

      headers: [
        "Status",
        "Name",
        "Ticket Number",
        "Mobile",
        "Email",
        "Created At",
      ],
    };
  },

  methods: {
    searchTicket() {
      let payload = {
        ticket_number: this.ticket_number,
        email: this.email,
      };
      let url = "frontend/search-ticket";
      HTTPWT.post(url, payload)
        .then((response) => {
          // console.log(response.data.data);
          this.searchTicketInfo = response.data.data;
          const data = {
            ticket_status: this.searchTicketInfo.status,
            ticket_name: this.searchTicketInfo.name,
            ticket_no: this.searchTicketInfo.ticket_number,
            ticket_mobile: this.searchTicketInfo.mobile,
            ticket_email: this.searchTicketInfo.email,
            ticket_created_at: this.searchTicketInfo.created_at,
          };
          console.log(this.searchTicketInfo);
          this.tickets = data;
          if(this.tickets.ticket_status==="Pending"){
            return this.attached=true,
                      this.searchTicketSuccess = true;
          }
          else return  this.searchTicketSuccess = true;
          this.searchTicketSuccess = true;
        })
        .catch((e) => {
          if (this.ticket_number == null && this.email == null) {
            return (
              (this.errorMessage = "Ticket Number And Email"),
              (this.dataNotFound = true)
            );
          } else if (this.ticket_number == null) {
            return (
              (this.errorMessage = "Ticket Number"), (this.dataNotFound = true)
            );
          } else if (this.email == null)
            return (this.errorMessage = "Email"), (this.dataNotFound = true);
        });
    },
  },
  components:{
    AppUserTicketReply
  }
};
</script>
<style lang="scss" scoped>
// .containerImage{

// }

.cardTitle {
  background-color: #1976d2 !important;
  position: absolute;
  width: 370px;
  height: 21%;
  top: -45px;
  left: -16px;
  color: white;
  border-radius: 10px 10px 0px 0px;
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
    0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
.v-list-item {
  padding: 0px;
}
.container {
  margin: 0 auto;
  position: relative;
}
.formCenter {
  width: 30%;
  position: absolute;
  top: 100%;
  left: 36%;
  margin-top: 90px;
  padding: 0px;
}

@media only screen and (min-width: 425px) {
  .formCenter {
    width: 76%;
    left: 12%;
  }
  .cardTitle {
    width: 350px;
    left: -12px;
  }
}
@media only screen and (min-width: 500px) {
  .formCenter {
    width: 65%;
    left: 17%;
  }
  .cardTitle {
    width: 350px;
    left: -12px;
  }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  .formCenter {
    width: 60%;
    left: 20%;
  }
  .cardTitle {
    width: 350px;
    left: -12px;
  }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .formCenter {
    width: 50%;
    left: 25%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}

@media only screen and (min-width: 948px) {
  .formCenter {
    width: 50%;
    left: 25%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}
@media only screen and (min-width: 960px) {
  .formCenter {
    width: 50%;
    left: 25%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}

@media only screen and (min-width: 990px) {
  .formCenter {
    width: 40%;
    left: 30%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
  .formCenter {
    width: 40%;
    left: 30%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1115px) {
  .formCenter {
    width: 40%;
    left: 30%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}
@media only screen and (min-width: 1235px) {
  .formCenter {
    width: 40%;
    left: 30%;
  }
  .cardTitle {
    width: 370px;
    left: -16px;
  }
}
@media only screen and (min-width: 1260px) {
  .formCenter {
    width: 40%;
    left: 36%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}
@media only screen and (min-width: 1265px) {
  .formCenter {
    width: 30%;
    left: 34%;
  }
  .cardTitle {
    width: 376px;
    left: -10px;
  }
}
.v-card {
  height: 85%;
}
.v-card__title {
  letter-spacing: 0.1em;
}
.inputField {
  height: 0px;
}
table {
  border-radius: 6px 6px 6px 6px;
}
th,
tr {
  font-size: 15px;
  text-align: center;
}
th {
  border-bottom: 0px;
}
td:nth-child(1) {
  background-color: blue;
}
.content-center{

      display: flex;
    flex-wrap: wrap;
    flex: 1 1 auto;
    margin-right: -12px;
    margin-left: -12px;
    justify-content: center;
}
.v-divider{
  margin-top:8px;
}
.green{
  background-color: green;
}
.red{
  background-color: red;
  border-radius: 5px;
    box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
}
.tokenSubtitle{
    display: flex;
    position: absolute;
    /* top: -10px; */
    /* left: 0px; */
    /* font-size: 0px; */
    color: darkgray;
}
.tokenSubtitle-1{
      width: 150px;
    font-size: 12px;
    margin-right: -9px;
}
.tokenSubtitle-2{
    font-size: 12px;
}



// .primaryTitle {
//   font-size: 1.5em;
//   background: #1976d2;
//   font-weight: bold;
//   color: white;
//   // padding: 1em 0.5em;
// }
</style>