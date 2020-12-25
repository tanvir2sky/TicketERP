<template>
  <v-data-table
    :headers="headers"
    :items="usersList"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>User List</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
              >New User</v-btn
            >
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.first_name"
                      label="First Name"
                      outlined
                      append-icon="email"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.last_name"
                      label="Last Name"
                      outlined
                      append-icon="email"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.email"
                      label="Email"
                      outlined
                      append-icon="email"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6" v-if="usertypeNew">
                    <v-text-field
                      v-model="editedItem.password"
                      label="Password"
                      outlined
                      append-icon="email"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                   
                    <v-select
                      :items="roleitems"
                      label="Role"
                      outlined
                      v-model="editedItem.role"
                    ></v-select>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.id="{ item }">{{
      usersList.indexOf(item) + 1
    }}</template>
    <template v-slot:item.actions="{ item }">
      <v-icon class="mr-2" @click="editItem(item)">
        edit
      </v-icon>
      <v-icon @click="deleteItem(item)">
        delete_forever
      </v-icon>
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
      {
        text: "id",
        align: "start",
        sortable: false,
        value: "id"
      },
      { text: "FirstName", value: "first_name" },
      { text: "LastName", value: "last_name" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role" },
      { text: "JoinDate", value: "created_at" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    roleitems: ['admin', 'agent'],
    usersList: [],
    editedIndex: -1,
    editedItem: {
      first_name: "",
      last_name: "",
      email: "",
      password: "",
      role: ""
    },
    defaultItem: {
      first_name: "",
      last_name: "",
      email: "",
      role: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New User" : "Edit User";
    },
    usertypeNew(){
      return this.editedIndex === -1 ? true : false;
    }
  },

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
      HTTP.get(`users`)
        .then(response => {
          // console.log(response.data);
          this.usersList = response.data.data.users;
          console.log(this.usersList);
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    createNewUser(payload){
      HTTP.post(`users`,payload)
        .then(response => {
        
          this.initialize();
         
        })
        .catch(e => {
         
        });
    },
    editUser(payload){
      // console.log(payload);
       HTTP.patch(`users/${payload.id}`,payload)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    deleteUser(payload){
       HTTP.delete(`users/${payload.id}`)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },


    editItem(item) {
      this.editedIndex = this.usersList.indexOf(item);
      // console.log(this.editedIndex);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.usersList.indexOf(item);
      
      confirm("Are you sure you want to delete this item?") &&
        this.usersList.splice(index, 1);
      this.deleteUser(item);
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        this.editUser(this.editedItem);
        Object.assign(this.usersList[this.editedIndex], this.editedItem);
      } else {
        // console.log(this.editedItem);
        this.createNewUser(this.editedItem);
        this.usersList.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
