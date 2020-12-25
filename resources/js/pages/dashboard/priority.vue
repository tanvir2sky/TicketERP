<template>
  <v-data-table
    :headers="headers"
    :items="priorityList"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Priority List</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
              >New Priority</v-btn
            >
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      v-model="editedItem.title"
                      label="Priority Name"
                      outlined
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" class="d-flex justify-center">
                    <v-color-picker
                      v-model="editedItem.color"
                      flat
                    ></v-color-picker>

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
      priorityList.indexOf(item) + 1
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
      { text: "Title", value: "title" },
      { text: "Color", value: "color" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    priorityList: [],
    editedIndex: -1,
    editedItem: {
      title:"",
      color:"",
    },
    defaultItem: {
      title:"",
      color:"",
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Priority" : "Edit Priority";
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
      HTTP.get(`priorities`)
        .then(response => {
          // console.log(response.data);
          this.priorityList = response.data.data.priorities;
          // this.initialize();
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    createNewPriority(payload){
      HTTP.post(`priorities`,payload)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    editPriority(payload){
       HTTP.patch(`priorities/${payload.id}`,payload)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    deletePriority(payload){
       HTTP.delete(`priorities/${payload.id}`)
        .then(response => {
          console.log(response.data);
         
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },


    editItem(item) {
      this.editedIndex = this.priorityList.indexOf(item);
      // console.log(this.editedIndex);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.priorityList.indexOf(item);
      
      confirm("Are you sure you want to delete this item?") &&
        this.priorityList.splice(index, 1);
        this.deletePriority(item);
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
        this.editPriority(this.editedItem);
        Object.assign(this.priorityList[this.editedIndex], this.editedItem);
      } else {
        console.log(this.editedItem)
        this.createNewPriority(this.editedItem);
        this.priorityList.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
